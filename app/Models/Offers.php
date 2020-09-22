<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Offers extends Model
{
    protected $table = 'offers';

    protected $fillable = ['title', 'image', 'adult_price', 'child_price', 'date_from', 'date_to', 'duration', 'gallery', 'country_id', 'user_id', 'slug'];

    protected $hidden = ['slug', 'created_at', 'updated_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\OffersCities', 'offer_id', 'id');
    }

}
