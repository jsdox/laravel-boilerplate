<?php

namespace App\Http\Controllers\App;
use App\Http\Controllers\Controller;



class ApiController extends Controller
{
    public function sendResponse($status_code, $sucess = true, $message = '', $data = '')
    {
        return response()->json([
            'message' => $message,
            'success' => $sucess,
            'status' => $status_code,
            'data' => $data
        ]);
    }
}
