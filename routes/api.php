<?php

use Illuminate\Support\Facades\Redis;

Route::group(['prefix' => config('constants.API_PREFIX'), 'middleware' => ['CheckHeaders']], function ()
{
    Route::get('/redis', function () {
        $visits = Redis::incr('visits');
        return $visits;
    });

    Route::get('/rollbar-test', function()
    {
        \Log::debug('Test debug message');
    });
    Route::get('/test', function()
    {
       return 'test';
    });
    Route::post('/users', 'UsersController@store');
    Route::get('/users', 'UsersController@get');
    Route::group(['middleware' => 'Token'], function()
    {
        Route::get('/users', function () {
            return 'User testing';
        });
    });
     Route::get('/pubtest', function()
    {
       return 'pubtest';
    });
});
