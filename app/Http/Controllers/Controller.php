<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
abstract class Controller
{
    
    public function input(Request $request)
    {
        $method = $request->getMethod();
        $input = ($method === 'POST') ? $request->post() : $request->get();

        if (empty($input)) {
            $input = json_decode($request->getBody(), true);
        }

        // Handle file uploads
        // $files = $request->getFiles();
        // if (!empty($files)) {
        //     foreach ($files as $key => $file) {
        //         $input[$key] = $file;
        //     }
        // }

        return $input;
    }
}
