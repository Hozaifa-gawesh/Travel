<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Countries extends Model
{
    protected $table = 'countries';

    protected $fillable = ['title', 'slug'];

    protected $hidden = ['slug', 'created_at', 'updated_at'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function cities()
    {
        return $this->hasMany('App\Models\Cities', 'country_id', 'id');
    }


    public function hotels()
    {
        return $this->hasManyThrough('App\Models\Hotels', 'App\Models\Cities', 'country_id', 'city_id');
    }

}
