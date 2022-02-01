<?php

namespace App\Models;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Revenue extends Authenticatable
{
    use HasApiTokens, HasFactory;

  
    protected $table = 'trn_revenue';
    protected $fillable = [
        'user_id',
        'plan_id',
        'status',
        'transaction_number',
        'amount',
        'start_date',
        'end_date',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
