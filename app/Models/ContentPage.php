<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class ContentPage extends Model
{
    use HasApiTokens, HasFactory;

    protected $table    = 'pg_content_pages';
    protected $fillable = [
        'is_active',
        'page_name'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
