<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qr_id',
        'name',
        'address',
        'phone_number',
        'date_joined'
    ];

    /**
     * The attributes that are hidden from the JSON array
     *
     * @var array
     */
    protected $hidden = ['id', 'created_at', 'updated_at'];
}