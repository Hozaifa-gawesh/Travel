<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        // Count Countries
        $countriesCount = Countries::count();
        // Count Cities
        $citiesCount = Cities::count();
        return view('dashboard.index', compact('countriesCount', 'citiesCount'));
    }
}
