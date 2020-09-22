<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OffersCities extends Model
{
    protected $table = 'offers_cities';

    protected $fillable = ['date_from', 'date_to', 'duration', 'hotel_id', 'room_type', 'offer_id', 'city_id'];

    public function city()
    {
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotels', 'hotel_id', 'id');
    }
}
