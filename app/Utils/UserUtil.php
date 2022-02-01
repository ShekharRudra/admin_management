<?php

namespace App\Utils;
use Illuminate\Http\Request;
use App\Models\Learn;
use App\Models\LearnLibrary;
use App\Models\User;
use DataTables;
use Session;
use Str;
use DB;

Class UserUtil
{
    public function profileAuth($request = NULL)
    {
        return User::select('id', 'email', 'plan_id', 'user_name', 'first_name', 'last_name', 'is_active', 'is_verified')->find(auth()->user()->id);
    }
}