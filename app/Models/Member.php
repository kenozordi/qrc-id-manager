<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qr_id',
        'qr_image_path',
        'name',
        'address',
        'phone_number',
        'email',
        'password',
        'link',
        'date_joined',
        'status'
    ];

    /**
     * The attributes that are hidden from the JSON array
     *
     * @var array
     */
    protected $hidden = ['password', 'id', 'created_at', 'updated_at'];
}
