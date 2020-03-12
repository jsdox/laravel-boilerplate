<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait RestTrait
{
    
    public function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}

