<?php

use Illuminate\Support\Facades\Route;

Route::get('/web', function () {
    return view('welcome');
});

Route::get("/clearData",function(){
    \Artisan::call('cache:clear');
     \Artisan::call('route:clear');
     \Artisan::call('config:cache');
     \Artisan::call('view:clear');
       return "Route cache cleared successfully!"; 
});
