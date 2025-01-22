<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RtiApplication;
use App\Models\Lawyer;
class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $applications = RtiApplication::list(false);
        $pending_application = collect($applications)->where('status', 1)->values();
        $approved_application = collect($applications)->where('status', 2)->values();
        $filed_application = collect($applications)->where('status', 3)->values();
        $today_applications = RtiApplication::list(false, ['date' => Carbon::now()]);
        $lawyers = Lawyer::list(true, ['status' => true]);

        return view('pages.dashboard', compact('today_applications', 'pending_application', 'approved_application', 'filed_application', 'applications', 'lawyers'));
    }
}
