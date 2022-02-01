<?php

namespace App\Models;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Plan extends Authenticatable
{
    use HasApiTokens, HasFactory;

  
    protected $table = 'mst_plan';
    protected $fillable = [
        'plan_name',
        'title',
        'description',
        'month',
        'amount',
        'plan_type',
        'is_active',
    ];
   
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
