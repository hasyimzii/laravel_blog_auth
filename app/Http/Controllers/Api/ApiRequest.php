<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ApiRequest
{
    public static function validator($allRequest, $rules)
    {
        $validator = Validator::make($allRequest, $rules);

        if ($validator->fails()) {
            return [
                'status' => false,
                'response' => response()->json($validator->errors()->all(), 401),
            ];
        }
        return [
            'status' => true,
        ];
    }
}