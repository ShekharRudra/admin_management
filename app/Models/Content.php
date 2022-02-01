<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Content extends Model
{
    use HasApiTokens, HasFactory;

    protected $table    = 'pg_contents';
    protected $fillable = [
        'tag_name',
        'page_name',
        'sequence_no',
        'side',
        'type',
        'image',
        'description',
        'is_active'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
