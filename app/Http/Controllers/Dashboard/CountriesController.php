<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Countries\StoreCountry;
use App\Http\Requests\Dashboard\Countries\UpdateCountry;
use App\Http\Requests\Dashboard\General\MultiDelete;
use App\Models\Countries;

class CountriesController extends GeneralController
{
    protected $viewPath = 'countries.';
    protected $path = 'countries';
    protected $paginate = 20;

    public function __construct(Countries $model)
    {
        parent::__construct($model);
    }

    /**
     * Get All Data Model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Get all data model
        $data = $this->model->withCount('cities')->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }


    /**
     * Store Data in DB
     * @param StoreCountry $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCountry $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Store Data in DB
        $this->model->create($inputs);
        $this->flash('success', __('lang.stored'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * View Details Item
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Items Related To Data
        $items = $data->cities()->withCount('hotels as hotels')->orderBy('id')->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'view'), compact('data', 'items'));
    }


    /**
     * Update Data in DB
     * @param UpdateCountry $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCountry $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Update Data in DB
        $data->update($inputs);
        $this->flash('success', __('lang.updated'));
        return back();
    }


    /**
     * Delete Data in DB
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        // Get and Check Data
        $data = $this->model->find($id);
        // Check If Not Get Data
        if(!$data) return back()->with('error', __('lang.invalid_data'));
        // Delete Data
        $data->delete();
        // If Request Ajax
        if(request()->ajax()) {
            $this->flash('success', __('lang.deleted'));
            return $this->sendResponse(null, __('lang.deleted'));
        } else {
            $this->flash('success', __('lang.deleted'));
            return redirect($this->urlPath($this->path));
        }
    }


    /**
     * Multi Delete Data
     * @param MultiDelete $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletes(MultiDelete $request)
    {
        // Get Data From Request
        $data = $request->input('data');
        // Delete Data
        $this->model->whereIn('id', $data)->delete();
        $this->flash('success', __('lang.deleted'));
        return back();
    }
}
