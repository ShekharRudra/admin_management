<?php

namespace App\Models;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class SubCategory extends Authenticatable {
    use HasApiTokens, HasFactory;

    protected $table    = 'mst_sub_category';
    protected $fillable = [
        'sub_category_id',
        'category_id',
        'sub_category',
        'is_active',

    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s'
    ];

}
