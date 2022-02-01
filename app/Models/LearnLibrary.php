<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use App\Models\Learn;

class LearnLibrary extends Model
{
    use HasApiTokens, HasFactory;

    protected $table    = 'mst_learn_library';
    protected $fillable = [
        'url',
        'file_name'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];
}
