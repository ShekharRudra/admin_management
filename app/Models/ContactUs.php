<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class ContactUs extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'contact_us';  
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'message',
        'is_read'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
    
}