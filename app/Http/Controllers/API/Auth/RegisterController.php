<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\Trn_Expense;
use App\Models\Trn_Expense_Sub;
use App\Models\Trn_Income;
use App\Models\ParameterValue;

use DB,Hash,Mail;
class RegisterController extends Controller
{
    public function register(Request $request) {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
        ]);
        
        $GetUser = User::where('email', $request->email)
                        ->where('user_type','=','1')
                        ->first();
        if($GetUser){   
            return response([
                'success' => false,
                'message' => 'This email address is already register with us. Please login to continue',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        }
        unset($data['confirm_password']);
        $token = Str::random(60);
        $data['remember_token'] = hash('sha256', $token);
        $data['user_name'] = $request->first_name." ".$request->last_name;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if($user)
        {    

            SetNewBudget($user->id);
            $notificationArray = [
                'user_id'  => $user->id,
                'title'    => 'New user has been registered.',
                'description' => $user['user_name'] .' has just created an account on '.env('APP_NAME').'.',
                'screen_no' => 1,
                'created_by'=> $user->id,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            DB::table('mst_user_notification')->insert($notificationArray);

            $userData = array(
                'token' => $user->remember_token,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            );
            $verifyLink = env('APP_URL').'verification/email?id='.$user->id.'&token='.$user->remember_token;
            $bodyHTML= [
                'first_name' => $user->first_name,
                'email' => $user->email,
                'verifyLink' => $verifyLink,
                'subject' => 'Verify Email Address',
                'view'=>'register'
            ];
            self::mailSend($bodyHTML);
            return response([
                'success' => true,
                'message' => 'Sign up success',
                'data' => $userData,
            ], config('constants.validResponse.statusCode')); 
        }
    }
    public function checkEmailVerify(Request $request) {
        $data = $request->validate([
            'id' => 'required',
            'token' => 'required',
        ]);
        $GetUser = User::where('remember_token', $request->token)
                        ->where('id','=',$request->id)
                        ->first();
        if($GetUser){
            DB::update('update users set is_verified=1 where id="' . $request->id . '"');
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Your Email has been verified. Please hit Continue.',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'Unable to verify your email address.This token is invalid.',
            'data'    => [],
        ],config('constants.validResponse.statusCode'));
    }
    public function checkForgotEmail(Request $request) {
        $data = $request->validate([
            'email' => 'required',
        ]);
        $GetUser = User::where('email', $request->email)->first();
        if($GetUser){
            $token = Str::random(60);
            $remember_token= hash('sha256', $token);
            DB::update('update users set remember_token="' . $remember_token . '" where id="' . $GetUser->id . '"');
            $verifyLink = env('APP_URL').'reset-password?token='.$remember_token;
            $bodyHTML= [
                'first_name' => $GetUser->first_name,
                'email' => $GetUser->email,
                'verifyLink' => $verifyLink,
                'subject' => 'Reset Password Notification',
                'view'=>'forgotPassword'
            ];
            self::mailSend($bodyHTML);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Reset link sent to your email.',
                'data'    => [],
            ], config('constants.validResponse.statusCode'));
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'Unable to send reset link',
            'data'    => [],
        ],config('constants.validResponse.statusCode'));
    }
    public function resetPassword(Request $request) {
        $data = $request->validate([
            'token' => 'required',
            'password' => 'min:8|required_with:confirm_password|same:confirm_password',
        ]);
        $GetUser = User::where('remember_token', $request->token)->first();
        if($GetUser){
            User::find($GetUser->id)
            ->update([
                'password' => Hash::make($request->password),
            ]);
            return response([
                'success' => config('constants.validResponse.success'),
                'message' => 'Reset password successful!',
            ], config('constants.validResponse.statusCode'));
        }
        return response([
            'success' => config('constants.invalidResponse.success'),
            'message' => 'This password reset token is invalid.',
            'data'    => [],
        ],config('constants.validResponse.statusCode'));
    }

    public static function mailSend($dataMail)
    {   
        Mail::send('emails.mail', ['bodyHTML' => $dataMail], function ($message) use ($dataMail) {
            $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'))
            ->to($dataMail['email'], $dataMail['first_name'])
            ->subject($dataMail['subject']);
        });
    }
}
