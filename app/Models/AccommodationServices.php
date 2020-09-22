<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccommodationServices extends Model
{
    protected $table = 'accommodation_services';

    protected $fillable = ['title'];

    protected $hidden = ['created_at', 'updated_at'];
}
