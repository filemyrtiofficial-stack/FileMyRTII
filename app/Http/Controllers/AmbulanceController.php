<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambulance;
class AmbulanceController extends Controller
{
    public function index(Request $request) {
       $ambulances = Ambulance::list(true, $request->all());
       return view('pages.ambulance.index', compact('ambulances'));
    }
}
