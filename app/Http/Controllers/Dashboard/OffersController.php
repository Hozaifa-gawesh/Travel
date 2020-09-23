<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Offers\CheckDate;
use App\Http\Requests\Dashboard\Offers\StoreImages;
use App\Http\Requests\Dashboard\Offers\StoreOffer;
use App\Http\Requests\Dashboard\Offers\UpdateOffer;
use App\Models\Countries;
use App\Models\Offers;
use Carbon\Carbon;

class OffersController extends GeneralController
{
    protected $viewPath = 'offers.';
    protected $path = 'offers';

    public function __construct(Offers $model)
    {
        parent::__construct($model);
    }


    /**
     * Get Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all data model
        $data = $this->model->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }


    public function country()
    {
        return Countries::whereHas('hotels', function ($q) {$q->where('hide', 0);});
    }


    /**
     * View Page Add New Data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Get All Countries Where Has Cities
        $countries = $this->country()->orderBy('title')->get();
        return view($this->viewPath($this->viewPath . 'create'), compact('countries'));
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
     * Get Duration
     * @param CheckDate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function duration(CheckDate $request)
    {
        if($request->ajax()) {
            // Parse & Check Date
            $diff = $this->checkDate($request->input('date_from'),$request->input('date_to') );
            return $diff ? $this->sendResponse($diff) : $this->flash('error', __('lang.invalid_data')); $this->errorResponse(__('lang.invalid_data'), null, 400);
        }
    }


    /**
     * Store Data in DB
     * @param StoreOffer $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreOffer $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Get & Check Country
        $country = $this->country()->find($request->input('country_id'));
        // If Not Get Country Data
        if(!$country) abort(404);
        // Set Duration in Inputs Request
        $inputs['duration'] = $this->checkDate($request->input('date_from'), $request->input('date_to'));
        // Check If Invalid Duration
        if(!$inputs['duration']) abort(404);
        // Set Image in inputs data
        $inputs['image'] = $this->storeFile($request->file('image'), $this->path, 'image', 800, null, 400, null, 1, 1);
        // Store Data in DB
        $this->model->create($inputs);
        $this->flash('success', trans('lang.stored'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * View Details Offer
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get All Countries Where Has Cities
        $countries = $this->country()->orderBy('title')->get();
        return view($this->viewPath($this->viewPath . 'view'), compact('data', 'countries'));
    }


    /**
     * Update Data in DB
     * @param UpdateOffer $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateOffer $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Get & Check Country
        $country = $this->country()->find($request->input('country_id'));
        // If Not Get Country Data
        if(!$country) abort(404);
        // Set Duration in Inputs Request
        $inputs['duration'] = $this->checkDate($request->input('date_from'), $request->input('date_to'));
        // Check If Invalid Duration
        if(!$inputs['duration']) abort(404);
        // Set Image in inputs data
        $inputs['image'] = $this->updateFile($request->file('image'), $this->path, 'image', $data->image, 800, null, 400, null, 1, 1);
        // Update Data in DB
        $data->update($inputs);
        $this->flash('success', trans('lang.updated'));
        return back();
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


    /**
     * Store & Edit Images Product
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        return view($this->viewPath($this->viewPath . 'gallery'), compact('data'));
    }


    public function ImUpdate($id, $img)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        $gallery = json_decode($data->gallery);
        array_push($gallery, $img);
        $update = json_encode($gallery);
        $data->update(['gallery' => $update]);
    }

    /**
     * Store Gallery related to Offer
     * @param StoreImages $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function galleryStore(StoreImages $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Set Images in Gallery
        foreach ($request->file('images') as $im)
        {
            // Push To Array
            $pic = $this->storeFile($im, $this->path.'/gallery', 'image', 1200, null, 600, null, 1, 1);
            $this->ImUpdate($data->id, $pic);
        }
        return $this->sendResponse(null, __('lang.stored'));
    }


    /**
     * Delete Image from DB
     * @param $id
     * @param $it
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function galleryDelete($id, $it)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Gallery Decoding Data
        $gallery = json_decode($data->gallery);
        // Check If Get Key Will Unset Of Array
        if(array_key_exists($it, $gallery)){
            // Delete Image
            $this->deleteImage($gallery[$it]);
            // Splice Index OF Gallery
            array_splice($gallery, $it,1);
        } else {abort(404);}
        $ar = json_encode($gallery);
        // Update Data
        $data->update(['gallery' => $ar]);
        $this->flash('success', trans('lang.deleted'));
        return back();
    }

}
