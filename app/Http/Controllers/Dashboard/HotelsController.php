<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Hotels\StoreHotel;
use App\Http\Requests\Dashboard\Hotels\UpdateHotel;
use App\Models\AccommodationServices;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Hotels;

class HotelsController extends GeneralController
{
    protected $viewPath = 'hotels.';
    protected $path = 'hotels';

    public function __construct(Hotels $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        // Get all data model
        $data = $this->model->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }


    /**
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Get All Countries Where Has Cities
        $countries = Countries::whereHas('cities')->orderBy('title')->get();
        // Get All Accommodation Services
        $services = AccommodationServices::get();
        return view($this->viewPath($this->viewPath . 'create'), compact('countries', 'services'));
    }


    /**
     * Looping For Services to Assign To AccommodationServices If Not Existing
     * @param $data
     */
    private function assignServices($data)
    {
        foreach ($data as  $item) {AccommodationServices::firstOrCreate(['title' => $item]);}
    }


    /**
     * Check Country & City
     * @param $inputs
     * @return mixed
     */
    private function checkCity($inputs)
    {
        return Cities::whereHas('country', function($q) use($inputs) {$q->where('id', $inputs['country']);})->find($inputs['city_id']);
    }

    /**
     * Store Data in DB
     * @param StoreHotel $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreHotel $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Get City
        $city = $this->checkCity($inputs);
        // Check If Not Get City
        if(!$city) abort(404);
        // Assign Services
        $this->assignServices($inputs['services']);
        // Set Encoding Format Services in Inputs Request
        $inputs['services'] = json_encode($request->input('services'));
        // Set Image in inputs data
        $inputs['image'] = $this->storeFile($request->file('image'), $this->path, 'image', 800, null, 400, null, 1, 1);
        // Store Data in DB
        $this->model->create($inputs);
        $this->flash('success', trans('lang.stored'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * View Page Edit Item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get All Countries Where Has Cities
        $countries = Countries::whereHas('cities')->orderBy('title')->get();
        // Get Cities Related To  Country ID
        $cities = Cities::whereHas('country', function ($q) use($data) {$q->where('id', $data->city->country_id);})->orderBy('title')->get();
        // Get All Accommodation Services
        $services = AccommodationServices::get();
        return view($this->viewPath($this->viewPath . 'edit'), compact('data','countries', 'cities', 'services'));
    }


    /**
     * Update Data in DB
     * @param UpdateHotel $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateHotel $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Get City
        $city = $this->checkCity($inputs);
        // Check If Not Get City
        if(!$city) abort(404);
        // Assign Services
        $this->assignServices($inputs['services']);
        // Set Encoding Format Services in Inputs Request
        $inputs['services'] = json_encode($request->input('services'));
        // Set Image in inputs data
        $inputs['image'] = $this->updateFile($request->file('image'), $this->path, 'image', $data->image, 800, null, 400, null, 1, 1);
        // Update Data in DB
        $data->update($inputs);
        $this->flash('success', trans('lang.updated'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * Delete Data from DB
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Delete images from folders
        $this->deleteImage($data->image);
        // Delete Data from DB
        $data->delete();
        $this->flash('success', trans('lang.deleted'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * Hidden Data in DB
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function hidden($id)
    {
        // Check & Hide Data
        $this->hiddenData($id);
        $this->flash('success', trans('lang.hide'));
        return back();
    }


    /**
     * Show Data in DB
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function show($id)
    {
        // Check & Hide Data
        $this->showData($id);
        $this->flash('success', trans('lang.show'));
        return back();
    }
}
