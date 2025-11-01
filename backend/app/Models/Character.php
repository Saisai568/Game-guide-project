<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_cn',
        'name_en',
        'tier',
        'element',
        'weapon_type',
        'image_url',
        'role',
    ];

    // If you want to customize the table name, uncomment the line below
    // protected $table = 'characters';
}
