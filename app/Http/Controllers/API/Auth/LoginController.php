<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use DB,Hash;

class LoginController extends Controller
{
    public function login(Request $request) {

        $data = $request->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'required',
        ]);
        $user = User::select('id as user_id', 'is_verified', 'email')
                ->where('email', $request->email)
                ->where('user_type','!=','0')
                ->where('is_active','=','1')
                ->first();
        if(!$user){
            return response([
                'success' => false,
                'message' => 'Invalid email and password',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }
        if($user->is_verified==0){
            return response([
                'success' => false,
                'message' => 'Please first verify your email address',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }

        if (!auth()->attempt($data)) {
            return response([
                'success' => false,
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
                'plan_id'   => auth()->user()->account_type_id,
                'fist_name'         => auth()->user()->fist_name,
                'last_name'              => auth()->user()->last_name,
                'email'             => auth()->user()->email,
                'access_token'      => $accessToken,
            );
            return response([
                'success' => true,
                'message' => 'Login successfully',
                'data'    => $userData,
            ], config('constants.validResponse.statusCode')); 
        }
        return response([
            'success' => false,
            'message' => 'Invalid email and password',
            'data'    => [],
        ], config('constants.invalidResponse.statusCode')); 
    }
}
