<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\CitiesOffer\HotelsByCity;
use App\Http\Requests\Dashboard\CitiesOffer\StoreCityOffer;
use App\Models\Cities;
use App\Models\Hotels;
use App\Models\Offers;
use Carbon\Carbon;

class CitiesOfferController extends GeneralController
{
    protected $viewPath = 'offers.items.';
    protected $path = 'offers';

    public function __construct(Offers $model)
    {
        parent::__construct($model);
    }

    /**
     * Get Data Model
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Pagination Cities Offer
        $items = $data->items()->with('city', 'hotel')->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data', 'items'));
    }


    /**
     * Parsing & Check Data
     * @param $from
     * @param $to
     * @return bool|int
     */
    public function checkDate($from, $to) {
        // Date From
        $from = Carbon::parse($from);
        // Date To
        $to = Carbon::parse($to);
        return $to > $from ? $to->diffInDays($from) : false;
    }


    /**
     * @param $id
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Using Cities
        $citiesIds = $data->items()->get()->pluck('city_id')->unique()->toArray();
        // Get All Countries Where Has Cities
        $cities = Cities::whereNotIn('id', $citiesIds)->where('country_id', $data->country_id)->whereHas('hotels', function ($q) {$q->where('hide', 0);})->get();
        // Get Bigger Date Of Cities Offer Related To Offer Id
        $bigDate = $data->items()->orderBy('date_to', 'DESC')->first();
        // Set Date Form
        $date_from = $bigDate ? $bigDate->date_to : $data->date_from;
        // Set NextDay
        $next_day = Carbon::parse($date_from)->addDay()->format('Y-m-d');
        // Check If Next Day Larger Than Date To
        if($next_day > $data->date_to) {
            $this->flash('error', 'You can\'t add more cities for this offer');
            return redirect(route('cities-offer', $data->id));
        }
        // Get Before Last Day
        $before_last_day = Carbon::parse($data->date_to)->addDays(-1)->format('Y-m-d');
        return view($this->viewPath($this->viewPath . 'create'), compact('data', 'cities', 'date_from', 'next_day', 'before_last_day'));
    }


    /**
     * Filter Hotels
     * @param $data
     * @param $request
     * @return mixed
     */
    public function filterHotels($data, $request)
    {
        // Pluck Hotels Ids Related To Offer
        $hotelsIds = $data->items()->get()->pluck('hotel_id')->unique()->toArray();
        // Get Hotels
        return Hotels::whereNotIn('id', $hotelsIds)->where('hide', 0)->where('city_id', $request->input('city_id'));
    }


    /**
     * Ajax Request To Get Hotels
     * @param HotelsByCity $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function hotels(HotelsByCIty $request, $id)
    {
        if($request->ajax()) {
            // Get and Check Data
            $data = $this->model->find($id);
            // If Not Get Data
            if(!$data) return $this->errorResponse(__('invalid_data'));
            // Get Hotels
            $hotels = $this->filterHotels($data, $request)->get();
            return $this->sendResponse($hotels);
        }
    }


    public function store(StoreCityOffer $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Inputs Request
        $inputs = $request->all();
        // Get Hotels
        $hotel = $this->filterHotels($data, $request)->find($inputs['hotel_id']);
        // Check If Not Get Hotel
        if(!$hotel) abort(404);
        // Get Bigger Date Of Cities Offer Related To Offer Id
        $bigDate = $data->items()->orderBy('date_to', 'DESC')->first();
        // Set Date Form
        $date_from = $bigDate ? $bigDate->date_to : $data->date_from;
        // Set NextDay
        $next_day = Carbon::parse($date_from)->addDay()->format('Y-m-d');
        // Check If Next Day Larger Than Date To
        if($next_day > $data->date_to) {
            $this->flash('error', 'You can\'t add more cities for this offer');
            return redirect(route('cities-offer', $data->id));
        }
        if($inputs['date_to'] < $next_day) {
            $this->flash('error', 'Invalid date to');
            return redirect(route('cities-offer', $data->id));
        }
        $inputs['date_from'] = $date_from;
        // Set Duration in Inputs Request
        $inputs['duration'] = $this->checkDate($date_from, $request->input('date_to'));
        // Check If Invalid Duration
        if(!$inputs['duration']) abort(404);
        // Store Data in DB
        $data->items()->create($inputs);
        $this->flash('success', trans('lang.stored'));
        return redirect(route('cities-offer', $data->id));
    }

}
