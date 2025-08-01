<?php

namespace Modules\Auth\Http\Controllers;
// use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{

    protected $userModel;
    protected $employeeModel;
    protected $registrationModel;
    protected $familyModel;
    protected $activityModel;
    protected $appdetailModel;
    protected $loginActivityModel;
    protected $baseLink;
    protected $request;

    public function __construct(Request $request)
    {
        // $this->userModel = new UsersModel();
        // $this->employeeModel = new EmployeeModel();
        // $this->registrationModel = new RegistrationModel();
        // $this->familyModel = new FamilyModel();
        // $this->appdetailModel = new AppDetailModel();
        // $this->activityModel = new UserActivityModel();
        // $this->loginActivityModel = new LoginActivityModel();
        // $this->baseLink = getenv('FRONT_END_BASE_URL');
        $this->request = $request;
    }


    public function index(){
        
    }

    public function login()
    {
        $validated = $request->validated();
        if ($this->userModel->needsPasswordReset($input['user_name'])) {
            return $this->fail('Password reset is required. Please reset your password.', ResponseInterface::HTTP_FORBIDDEN);
        }

        // Check for 2FA remember token from headers
        $rememberToken = $this->request->getHeaderLine('X-2FA-Remember-Token') ?: null;

        return $this->getJWTForUser($input['user_name'], $input['password'], $rememberToken);
    }


   
    public function isAuthenticated()
    {
        $authHeader = $this->request->getHeader('Authorization');

        if (!$authHeader) {
            return $this->failUnauthorized('Authorization header missing');
        }

        $authenticationHeader = $authHeader->getValue();
        $token = explode(' ', $authenticationHeader)[1];
        try {
            $decodedToken = $this->validateJWT($token);
            if (!$decodedToken) {
                return $this->failUnauthorized('Invalid token');
            }

            // Extend token expiry time by 1 hour
            $decodedToken->exp = time() + getenv('JWT_TIME_TO_LIVE');
            $newToken = JWT::encode((array)$decodedToken, Services::getJWTSecretKey(), 'HS256');

            return $this->respond([
                'status' => 'success',
                'message' => 'User is authenticated',
                'token' => $newToken,
            ]);
        } catch (Exception $e) {
            return $this->failUnauthorized($e->getMessage());
        }
    }

    private function validateJWT(string $encodedToken)
    {
        $key = Services::getJWTSecretKey();
        return JWT::decode($encodedToken, new Key($key, 'HS256'));
    }
    /**
     * getJWTForUser
     *
     * @param  string $user_name
     * @param  string $password
     * @param  string $rememberToken
     * @param  int $responseCode
     * @return void
     */

    // private function getJWTForUser(string $username, string $password, $rememberToken = null, int $responseCode = ResponseInterface::HTTP_OK)
    // {
    //     try {
    //         /*$users = $this->userModel->findUserByUsernameAndPassword($username, sha1(md5($password)));

    //         if (!empty($users)) {
    //             $employeeDetail = $this->employeeModel->getEmployeeDetailByUserId($users['id']);
    //             $authenticatedUserDetail = $this->userDetail($users, $employeeDetail);
    //             $response = [
    //                 'user' => $authenticatedUserDetail,
    //                 'token' => getSignedJWTForUser($users['id'], $employeeDetail['id']),
    //             ];
    //         }
    //         return $this->respond($response);*/
    // $incomingPassword = $type ? $password : sha1(md5($password));
    //             $users = $this->findUsersByUsernameAndPassword($username, $incomingPassword);
    //         $users = $this->findUsersByUsernameAndPassword($username, sha1(md5($password)));
    //         $response = [];
    //         foreach ($users as $user) {
    //             if (!empty($user)) {
    //                 $employeeDetail = $this->employeeModel->getEmployeeDetailByUserId($user['id']);
    //                 $authenticatedUserDetail = $this->userDetail($user, $employeeDetail);
    //                 $response[] = [
    //                     'user' => $authenticatedUserDetail,
    //                     'token' => getSignedJWTForUser($user['id'], $employeeDetail['id']),    //                 ];
    //             }
    //         }
    //         return $this->respond($response);
    //     } catch (Exception $exception) {
    //         return $this->failNotFound($exception->getMessage());
    //     }
    // }

    private function getJWTForUser(string $username, string $password, $rememberToken = null, $type = null, int $responseCode = ResponseInterface::HTTP_OK)
    {
        try {
            $users = $this->findUsersByUsernameAndPassword($username, $password, $type);
            $response = [];
            foreach ($users as $user) {
                if (!empty($user)) {
                    if ($user['user_type'] === 'student') {
                        $employeeDetail = $this->registrationModel->getStudentDetailByUserId($user['id']);
                    } elseif ($user['user_type'] === 'family') {
                        $employeeDetail = $this->familyModel->getFamilyDetailByUserId($user['id']);
                    } else {
                        $employeeDetail = $this->employeeModel->getEmployeeDetailByUserId($user['id']);
                    }

                    // Check 2FA requirement
                    $user2faModel = new \App\Models\User2FAModel();
                    $twoFACheck = $user2faModel->check2FAOnLogin($user['id'], $rememberToken);

                    if ($twoFACheck['require_2fa'] && $type !== 'google') {
                        // User has 2FA enabled and needs to verify
                        $tempToken = $this->generateTempJWT($user['id']);
                        $authenticatedUserDetail = $this->userDetail($user, $employeeDetail);
                        $empData = [
                            'logo' => $authenticatedUserDetail['logo'],
                            'user_name' => $authenticatedUserDetail['user_name'],
                            'user_type' => $authenticatedUserDetail['user_type'],
                            'company_name' => $authenticatedUserDetail['company_name'],
                            'employee_name' => $authenticatedUserDetail['employee_name'],
                        ];
                        $response[] = [
                            'requires_2fa' => true,
                            'temp_token' => $tempToken,
                            'user_id' => $user['id'],
                            'message' => '2FA verification required',
                            'user' => $empData,
                        ];
                    } else {
                        // User doesn't have 2FA or is remembered
                        $authenticatedUserDetail = $this->userDetail($user, $employeeDetail);
                        $response[] = [
                            'requires_2fa' => false,
                            'user' => $authenticatedUserDetail,
                            'token' => getSignedJWTForUser($user['id']),
                        ];
                    }
                }
            }
            return $this->respond($response);
        } catch (Exception $exception) {
            return $this->failNotFound($exception->getMessage());
        }
    }

    public function findUsersByUsernameAndPassword(string $username, string $password, $type = null)
    {
        if ($type === 'google') {
            // For Google login, use the Google ID as password
            $password = $password; // Google ID is already hashed
        } else {
            // For normal login, hash the password
            $password = sha1(md5($password));
        }
        $builder = $this->userModel
            ->select('t17user.*')
            ->where([
                't17user.user_name' => $username,
                't17user.status' => 'Active',
                't17user.deleted_at' => null,
            ]);
        if ($type === 'google') {
            $builder = $builder->where('t17user.google_id', $password);
        } else {
            $builder = $builder->where('t17user.password', $password);
        }
        $users = $builder->findAll();
        if (empty($users)) {
            throw new Exception('User does not exist for specified user name or is not active');
        }
        return $users;
    }
    // public function findUsersByUsernameAndPassword(string $username, string $password, $type = null)
    // {
    //     if ($type === 'google') {
    //         // For Google login, use the Google ID as password
    //         $password = $password; // Google ID is already hashed
    //     } else {
    //         // For normal login, hash the password
    //         $password = sha1(md5($password));
    //     }
    //     $builder = $this->userModel
    //         ->select('t17user.*, t15employee.employee_status')
    //         ->join('t15employee', 't15employee.user_id = t17user.id')
    //         ->where([
    //             't17user.user_name' => $username,
    //             't17user.status' => 'Active',
    //             't15employee.employee_status' => 'Active',
    //             't17user.deleted_at' => null,
    //         ]);
    //     if ($type === 'google') {
    //         $builder = $builder->where('t17user.google_id', $password);
    //     } else {
    //         $builder = $builder->where('t17user.password', $password);
    //     }
    //     $users = $builder->findAll();
    //     if (empty($users)) {
    //         throw new Exception('User does not exist for specified user name or is not active');
    //     }
    //     return $users;
    // }
    public function userDetail($userDetail, $employeeDetail)
    {

        $user2faModel = new \App\Models\User2FAModel();
        $singleUserDetail = array();
        if (empty($employeeDetail['photo'])) {
            $profileimage = "";
        } else {
            $profileimage = $employeeDetail['photo'];
        }
        $userRoles =  getUserRolesByIdForFirstLogin($userDetail['id'], $employeeDetail['app_detail_id']);

        $company = $this->appdetailModel->select('t01appdetail.*,t00currencies.symbol')
            ->join('t00currencies', 't00currencies.id=t01appdetail.currency_id ')
            ->where(['t01appdetail.id' => $employeeDetail['app_detail_id']])->first();

        $logo = $company['logo'] ?? '';
        $currency = $company['symbol'] ?? '';
        $time_zone = getTimzeoneByApp($employeeDetail['app_detail_id']);
        $time_zone_id = getTimzeoneByAppId($employeeDetail['app_detail_id']);
        $company_name = $company['business_name'] ?? '';
        $userId = $userDetail['id'] ?? null;
        $user2fa = $user2faModel->where('user_id', $userId)->where('enabled', 1)->first();

        $singleUserDetail =
            [
                'id' => $employeeDetail['id'],
                'two_fa_enabled' => $user2fa ? true : false,
                'time_zone' => $time_zone,
                'time_zone_value' => $time_zone_id,
                'company_name' => $company_name,
                'user_type' => $userDetail['user_type'],
                'employee_name' => $employeeDetail['employee_name'],
                'designation_id' => $employeeDetail['designation_id'] ?? null,
                'department_id' => $employeeDetail['department_id'] ?? null,
                'user_name' => $userDetail['user_name'],
                'email' => $employeeDetail['email'],
                'city' => $employeeDetail['city'],
                'photo' => $profileimage,
                'logo' => $logo,
                'currency' => $currency,
                'employee_status' => $employeeDetail['employee_status'],
                'user_id' => $employeeDetail['user_id'],
                'app_detail_id' => $employeeDetail['app_detail_id'],
                'user_roles' => $userRoles,
            ];
        $this->userActivity($singleUserDetail);

        return $singleUserDetail;
    }

    private function userActivity($singleUserDetail)
    {

        $agent = $this->input($this->request);
        $browser = $agent['browser'] ?? '';
        $operatingSystem = $agent['operatingSystem'] ?? '';
        $IPAddress = $agent['ipaddress'] ?? '';
        $location = $agent['location'] ?? '';

        // $currentTime = date('Y-m-d H:i:s');

        $currentTime = timezoneToUtc(date('Y-m-d H:i:s'), getAppTimezone($singleUserDetail['app_detail_id']));


        $data = [
            'last_activity_time' => timezone_to_utc(date('Y-m-d H:i:s'), getAppTimezone($singleUserDetail['app_detail_id'])),
            'browser' => $browser,
            'operating_system' => $operatingSystem,
            'ipaddress' => $IPAddress,
            'location' => $location,
            'user_id' => $singleUserDetail['user_id'],
            'app_id' => 1,
            'app_detail_id' => $singleUserDetail['app_detail_id'],
        ];
        $this->loginActivityModel->insert($data);
    }

    public function logOut()
    {
        $rules = [
            'user_id' => 'required',
        ];

        $errors = [
            'user_id' => [
                'required' => 'User id field is required.',
            ],
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }
        getSignedJWTForUserToLogout($input['user_id']);
        return $this->respond(
            [
                'status' => 'success',
                'message' => 'User logged out successfully',
            ]
        );
    }

    public function forgotPassword()
    {
        $rules = [
            'email' => 'required|valid_email|emailExists[email]'
        ];
        $errors = [
            'email' => [
                'emailExists' => 'Email does not exist in our system.'
            ]
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $user = $this->userModel->findUserByEmailWithActiveNotDeleted($input['email']);
        $resetToken = $this->generateResetToken($user['id']);
        $resetLink = "{$this->baseLink}/reset-password?token={$resetToken}";

        $this->sendResetEmail($input['email'], getEmployeeNameByUserId($user['id']), $resetLink);

        return $this->respond([
            'status' => 'success',
            'message' => 'Password reset link has been sent to your email.'
        ]);
    }

    private function sendResetEmail($email, $name, $resetLink)
    {
        $emailService = new \App\Services\EmailService();
        $subject = "Password Reset Request";
        $message = "Click the following button to reset your password.</a>";
        $buttonText = "Reset Your Password.</a>";
        $emailService->SendAuthTemplateEmail($email, $name, $subject, $message, $resetLink, $buttonText);
    }

    public function resetPassword()
    {
        $rules = [
            'token' => 'required',
            'password' => 'required|min_length[8]|isStrongPassword[password]',
            'confirm_password' => 'required|min_length[8]|matches[password]',
        ];
        $errors = [
            'password' => [
                'required' => 'Password is required',
                'min_length' => 'Password must be at least 8 characters long',
                'isStrongPassword' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.'
            ],
            'confirm_password' => [
                'required' => 'Confirm password is required',
                'min_length' => 'Confirm password must be at least 8 characters long',
                'matches' => 'Confirm password must match the password',
            ],
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $userId = $this->validateResetToken($input['token']);
        if (!$userId) {
            return $this->failUnauthorized('Invalid or expired reset token.');
        }
        $this->userModel->update($userId, [
            'password' => sha1(md5($input['password'])),
            'force_password_reset' => 0,
            // 'google_id' => NULL
        ]);
        return $this->respond([
            'status' => 'success',
            'message' => 'Password has been reset successfully.'
        ]);
    }

    public function forceResetPassword()
    {
        $rules = [
            'user_id' => 'required',
        ];
        $errors = [
            'user_id' => [
                'required' => 'User id field is required.',
            ],
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        $userId = $input['user_id'];
        $this->userModel->update($userId, ['force_password_reset' => 1]);
        return $this->respond([
            'status' => 'success',
            'message' => 'Password reset has been forced for the user.' . $userId
        ]);
    }


    public function changePassword()
    {


        $rules = [
            'current_password' => 'required',
            'password' => 'required|min_length[8]|isStrongPassword[password]',
            'confirm_new_password' => 'required|min_length[8]|matches[password]',
        ];
        $errors = [
            'password' => [
                'required' => 'password is required',
                'min_length' => 'Password must be at least 8 characters long',
                'isStrongPassword' => 'Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.'
            ],
            'confirm_new_password' => [
                'required' => 'Confirm password is required',
                'min_length' => 'Confirm password must be at least 8 characters long',
                'matches' => 'Confirm password must match the password',
            ],
        ];


        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }

        // Get current user (implementation depends on your auth system)
        $userId = userId(); // You'll need to implement this based on your auth system
        $user = $this->userModel->where('id', $userId)->first();
        // Verify current password
        if (sha1(md5($input['current_password'])) !== $user['password']) {
            return $this->failUnauthorized('Current password is incorrect.');
        }

        // Update password
        $this->userModel->update($userId, [
            'password' => sha1(md5($input['password'])),
            'force_password_reset' => 0,
            // 'google_id' => NULL // Reset Google ID if it was set
        ]);

        return $this->respond([
            'status' => 'success',
            'message' => 'Password has been changed successfully.'
        ]);
    }


    public function resetTokenValidation()
    {
        $rules = [
            'token' => 'required',
        ];
        $errors = [
            'token' => [
                'required' => 'Token is required.',
            ],
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors(
                $this->validator->getErrors()
            );
        }
        $userId = $this->validateResetToken($input['token']);
        if (!$userId) {
            return $this->failUnauthorized('Invalid or expired reset token.');
        }
        return $this->respond([
            'status' => 'success',
            'message' => 'Valid.'
        ]);
    }

    private function generateResetToken($userId)
    {
        $issuedAtTime = time();
        $tokenExpiration = $issuedAtTime + getenv('RESET_JWT_TIME_TO_LIVE');
        $payload = [
            'user_id' => $userId,
            'iat' => $issuedAtTime,
            'exp' => $tokenExpiration
        ];
        return JWT::encode($payload, Services::getJWTSecretKeyForResetToken(), 'HS256');
    }
    private function validateResetToken($token)
    {
        try {
            $decodedToken = JWT::decode($token, new Key(Services::getJWTSecretKeyForResetToken(), 'HS256'));
            return $decodedToken->user_id;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Generate temporary JWT for 2FA verification
     */
    private function generateTempJWT($userId)
    {
        $issuedAtTime = time();
        $tokenExpiration = $issuedAtTime + 300; // 3 minutes for 2FA completion
        $payload = [
            'user_id' => $userId,
            'requires_2fa' => true,
            'iat' => $issuedAtTime,
            'exp' => $tokenExpiration
        ];
        return JWT::encode($payload, Services::getJWTSecretKey(), 'HS256');
    }

    /**
     * Complete 2FA verification and get full access token
     */
    public function complete2FA()
    {
        $rules = [
            'code' => 'required',
            'temp_token' => 'required',
            'remember' => 'permit_empty|in_list[0,1]',
        ];
        $errors = [
            'code' => [
                'required' => 'Code is required.',
            ],
            'temp_token' => [
                'required' => 'Temporary token is required.',
            ],
        ];

        $input = $this->input($this->request);
        if (!$this->validate($rules, $errors)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        try {
            // Validate temporary token
            $decodedToken = $this->validateJWT($input['temp_token']);
            if (!$decodedToken || !$decodedToken->requires_2fa) {
                return $this->failUnauthorized('Invalid temporary token.');
            }

            $userId = $decodedToken->user_id;
            $code = $input['code'];
            $remember = isset($input['remember']) && $input['remember'] == 1;

            // Verify 2FA code
            $user2faModel = new \App\Models\User2FAModel();
            $row = $user2faModel->where('user_id', $userId)->where('enabled', 1)->first();
            if (!$row) {
                return $this->failNotFound('2FA not enabled.');
            }

            $google2fa = new \App\Libraries\Google2FAService();
            if ($google2fa->verifyCode($row['secret'], $code)) {
                $response = ['status' => 'verified'];

                // Handle remember option
                if ($remember) {
                    $rememberToken = $user2faModel->set2FARemember($userId, 1);
                    if ($rememberToken) {
                        $response['remember_token'] = $rememberToken;
                        $response['remember_expires_at'] = date('Y-m-d H:i:s', strtotime('+30 days'));
                    }
                }                // Get user details and generate full access token
                $user = $this->userModel->find($userId);

                // Get appropriate detail based on user type
                if ($user['user_type'] === 'student') {
                    $employeeDetail = $this->registrationModel->getStudentDetailByUserId($userId);
                } elseif ($user['user_type'] === 'family') {
                    $employeeDetail = $this->familyModel->getFamilyDetailByUserId($userId);
                } else {
                    $employeeDetail = $this->employeeModel->getEmployeeDetailByUserId($userId);
                }

                $authenticatedUserDetail = $this->userDetail($user, $employeeDetail);

                $response['user'] = $authenticatedUserDetail;
                $response['token'] = getSignedJWTForUser(
                    $decodedToken->user_id
                );

                return $this->respond($response);
            }

            return $this->fail('Invalid 2FA code.');
        } catch (Exception $e) {
            return $this->failUnauthorized('Invalid temporary token.');
        }
    }
}