<?php

namespace App\Models;
use App\Models\PlanFeatures;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class PlanFeatures extends Authenticatable
{
    use HasApiTokens, HasFactory;

  
    protected $table = 'mst_plan_features';
    protected $fillable = [
        'features',
        'sequence_no'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
   
}
