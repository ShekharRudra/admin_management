<?php

namespace App\Http\Controllers\API\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;
use App\Utils\LearnUtil;
use App\Utils\UserUtil;
use App\Models\Plan;
use Auth;
use Artisan;

class FrontUserController extends Controller
{
    protected $userUtil;
    public function __construct(UserUtil $userUtil)
    {
        $this->middleware('auth');
        $this->userUtil = $userUtil;
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['required', 'same:new_password'],
        ]); 

        DB::beginTransaction();
        try {
            $user = User::where('is_active','=','1')->find(auth()->user()->id);
            if($user)
            {
                $user->update(['password'=> Hash::make($request->new_password)]); 
                DB::commit();
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Password has been changed',
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Password not updated!',
                'data'    => config('constants.emptyData'),
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => config('constants.emptyData'),
            ], Config('constants.invalidResponse.statusCode'));
        }
    }

    public function profileUpdate(Request $request){
        $request->validate([
            // 'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'first_name' => 'required',
            'last_name' => 'required'
        ]);  
        DB::beginTransaction();
        try {
            $user = User::where('is_active','=','1')->find(auth()->user()->id);
            if($user)
            {
                $user->update([
                    // 'email'=> $request->email, 
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'user_name' => $request->first_name." ".$request->last_name
                ]); 
                DB::commit();
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Profile has been Updated',
                    'data' => $this->userUtil->profileAuth($request)
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Profile not updated!',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => Config('constants.emptyData'),
            ], Config('constants.invalidResponse.statusCode'));
        }
    }

    /* profile List */
    public function profileList(Request $request)
    {
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Profile List',
            'data' => $this->userUtil->profileAuth($request)
        ], config('constants.validResponse.statusCode'));
    }

    /* profile Account Delete */
    public function profileAccountDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = User::where('user_type','!=','0')->where('is_active','=','1')->find(auth()->user()->id);
            if($user)
            {
                $user->delete();
                DB::commit();
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Account has been deleted'
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Account not deleted!',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => config('constants.emptyData'),
            ], config('constants.invalidResponse.statusCode'));
        }
    } 

    /* plan Select */
    public function planSelect(Request $request)
    {
        $request->validate([
            'plan_id' => 'required'
        ]);  
        DB::beginTransaction();
        try {
            $user = User::where('user_type','!=','0')->where('is_active','=','1')->find(auth()->user()->id);
            $plan = Plan::find($request->plan_id);
            if($user && $plan)
            {
                $user->update([
                    'plan_id' => $plan->id
                ]);
                DB::commit();
                return response([
                    'success' => config('constants.validResponse.success'),
                    'message' => 'Plan has been accepted.'
                ], config('constants.validResponse.statusCode'));
            }
            return response([
                'success' => config('constants.invalidResponse.success'),
                'message' => 'Plan not accepted!',
                'data'    => [],
            ], config('constants.invalidResponse.statusCode'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => $th->getMessage(),
                'data'    => config('constants.emptyData'),
            ], config('constants.invalidResponse.statusCode'));
        }
    }

    /* logout */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        // Artisan::call('config:cache');
        // Artisan::call('cache:clear');
        // Artisan::call('config:clear');
        // Artisan::call('view:clear');
        // Artisan::call('route:clear');

        if ($request->everywhere) {
            foreach ($request->user()->tokens()->whereRevoked(0)->get() as $token) {
                $token->revoke();
            }
        }
        return response([
            'success' => config('constants.validResponse.success'),
            'message' => 'Logout Success.'
        ], config('constants.validResponse.statusCode'));
    }
}