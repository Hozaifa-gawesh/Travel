<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\General\MultiDelete;
use App\Http\Requests\Dashboard\Services\StoreService;
use App\Http\Requests\Dashboard\Services\UpdateService;
use App\Models\AccommodationServices;

class ServicesController extends GeneralController
{
    protected $viewPath = 'services.';
    protected $path = 'services';

    public function __construct(AccommodationServices $model)
    {
        parent::__construct($model);
    }


    public function index()
    {
        // Get Data From DB
        $data = $this->getData()->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }



    /**
     * Store Data in DB
     * @param StoreService $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreService $request)
    {
        // Get data from request
        $inputs = $request->validated();
        // Store Data in DB
        $this->model->create($inputs);
        $this->flash('success', __('lang.stored'));
        return redirect($this->urlPath($this->path));
    }


    /**
     * Update Data in DB
     * @param UpdateService $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateService $request, $id)
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
