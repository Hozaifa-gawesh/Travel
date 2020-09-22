<?php

namespace App\Http\Controllers;

use App\Http\Requests\General\CitiesByCountry;
use App\Models\Countries;
use Illuminate\Support\Facades\Session;

class CitiesCountryController extends Controller
{
    public function cities(CitiesByCountry $request)
    {

        if($request->ajax()) {
            // Get Country By Request ID
            $data = Countries::whereHas('cities')->find($request->input('country'));
            // Check If Not Get Country
            if(!$data) {
                // Set array response data
                $response = [
                    'status' => false,
                    'message' => __('lang.invalid_data')
                ];
                Session::flash('error', __('lang.invalid_data'));
                return response()->json($response, 404);
            }
            // Set array response data
            $response = [
                'status' => true,
                'data' => $data->cities()->orderBy('title')->get()
            ];
            return response()->json($response, 200);
        }
        return back()->with('error', __('lang.invalid_data'));
    }
}
