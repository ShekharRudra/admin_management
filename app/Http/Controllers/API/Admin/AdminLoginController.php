<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use DB,Hash;
class AdminLoginController extends Controller
{
    
    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = User::select('id as user_id', 'email')
                ->where('email', $request->email)
                ->where('user_type','=','0')
                ->first();
        if (!auth()->attempt($data)) {
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Invalid email and password',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }
       
        if (auth()->user()) {
            $accessToken = auth()->user()->createToken('APIToken')->accessToken;
            $userData = auth()->user()->bussiness_name;
            $userData = array(
                'user_id'           => auth()->user()->id,
                'user_type' => auth()->user()->user_type,
                'plan_id'   => auth()->user()->plan_id,
                'first_name'         => auth()->user()->first_name,
                'last_name'              => auth()->user()->last_name,
                'email'             => auth()->user()->email,
                'access_token'      => $accessToken,
            );
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Login successfully',
                'data'    => $userData,
            ], config('constants.validResponse.statusCode'));
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'Invalid email and password',
            'data'    => [],
        ], config('constants.invalidResponse.statusCode'));
    }
}
