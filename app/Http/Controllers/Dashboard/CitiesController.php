<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\GeneralController;
use App\Http\Requests\Dashboard\Cities\StoreCity;
use App\Http\Requests\Dashboard\Cities\UpdateCity;
use App\Models\Cities;
use App\Models\Countries;

class CitiesController extends GeneralController
{
    protected $viewPath = 'countries.cities.';
    protected $path = 'cities';
    protected $paginate = 20;

    public function __construct(Countries $model)
    {
        parent::__construct($model);
    }


    /**
     * View Page Add New Item
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create($id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        return view($this->viewPath($this->viewPath . 'create'), compact('data'));
    }


    /**
     * Store City Related To Specific Country ID
     * @param StoreCity $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCity $request, $id)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get data from request
        $inputs = $request->validated();
        // Set Image In Inputs Request
        $inputs['image'] = $this->storeFile($request->file('image'), $this->path, 'image', 800, null, 400, null, 1, 1);
        // Store Data in DB
        $data->cities()->create($inputs);
        $this->flash('success', trans('lang.stored'));
        return redirect(route('view-country', $data->id));
    }


    /**
     * View Page Edit Item
     * @param $id
     * @param $it
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function view($id, $it)
    {
        // Get Data City With Country & Hotels
        $data = Cities::whereHas('country', function ($q) use ($id) {$q->where('id', $id);})->with('country', 'hotels')->find($it);
        // Check If Not Get Item
        if(!$data) abort(404);
        // Get Pagination Hotels
        $items = $data->hotels()->paginate($this->paginate);
        return view($this->viewPath($this->viewPath . 'view'), compact('data', 'items'));
    }


    /**
     * View Page Edit Item
     * @param $id
     * @param $it
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit($id, $it)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Item By ID Related to Data ID
        $item = $data->cities()->find($it);
        // Check If Not Get Item
        if(!$item) abort(404);
        return view($this->viewPath($this->viewPath . 'edit'), compact('data', 'item'));
    }

    /**
     * Update Data City
     * @param UpdateCity $request
     * @param $id
     * @param $it
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(UpdateCity $request, $id, $it)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Item By ID Related to Data ID
        $item = $data->cities()->find($it);
        // Check If Not Get Item
        if(!$item) abort(404);
        // Get Inputs Data From Request
        $inputs = $request->validated();
        // Set Image In Inputs Request
        $inputs['image'] = $this->updateFile($request->file('image'), $this->path, 'image', $item->image, 800, null, 400, null, 1, 1);
        // Update Data Item in DB
        $item->update($inputs);
        $this->flash('success', trans('lang.updated'));
        return redirect(route('view-country', $data->id));
    }


    /**
     * Update Data in DB
     * @param $id
     * @param $it
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id, $it)
    {
        // Get and Check Data
        $data = $this->GetItem($id);
        // Get Item By ID Related to Data ID
        $item = $data->cities()->find($it);
        // Check If Not Get Item
        if(!$item) abort(404);
        // Delete image Item from folders
        $this->deleteImage($item->image);
        // Delete Data
        $item->delete();
        $this->flash('success', trans('lang.deleted'));
        return redirect(route('view-country', $data->id));
    }

}
