<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hotels extends Model
{
    protected $table = 'hotels';

    protected $fillable = ['title', 'image', 'services', 'city_id', 'slug', 'hide'];

    protected $hidden = ['slug', 'city_id', 'created_at', 'updated_at', 'hide'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }
}
