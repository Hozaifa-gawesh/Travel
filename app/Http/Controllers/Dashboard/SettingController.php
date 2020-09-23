<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Setting\UpdateSetting;
use App\Models\Setting;

class SettingController extends GeneralController
{

    protected $viewPath = 'setting.';
    protected $path = 'setting';

    public function __construct(Setting $model)
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
        $data = $this->model->first();
        return view($this->viewPath($this->viewPath . 'index'), compact('data'));
    }


    /**
     * Update Data in DB
     * @param UpdateSetting $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateSetting $request)
    {
        // Get and Check Data
        $data = $this->model->first();
        // Check Data
        if(!$data) abort(404);
        // Get data from Request
        $inputs = $request->validated();
        // Set Image in inputs data
        $inputs['logo'] = $this->updateFile($request->file('logo'), $this->path, 'image', $data->logo);
        $inputs['logo_white'] = $this->updateFile($request->file('logo_white'), $this->path, 'image', $data->logo_white);
        $inputs['favicon'] = $this->updateFile($request->file('favicon'), $this->path, 'image', $data->favicon, 100, 100);
        $inputs['favicon_white'] = $this->updateFile($request->file('favicon_white'), $this->path, 'image', $data->favicon_white, 100, 100);
        // Update Data in DB
        $data->update($inputs);
        $this->flash('success', trans('lang.updated'));
        return back();
    }
}
