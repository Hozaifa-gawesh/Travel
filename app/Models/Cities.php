<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cities extends Model
{
    protected $table = 'cities';

    protected $fillable = ['title', 'image', 'slug', 'country_id'];

    protected $hidden = ['slug', 'country_id', 'created_at', 'updated_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Countries', 'country_id', 'id');
    }

    public function hotels()
    {
        return $this->hasMany('App\Models\Hotels', 'city_id', 'id');
    }
}
