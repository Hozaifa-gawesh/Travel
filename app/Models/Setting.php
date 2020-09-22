<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'sm_description',
        'phone_1',
        'phone_2',
        'email_1',
        'email_2',
        'logo',
        'logo_white',
        'favicon',
        'favicon_white',
        'address',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'keywords',
        'description',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
