<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RtiApplication;
use App\Models\Lawyer;
use App\Models\ApplicationCloseRequest;
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

        $applications = RtiApplication::all();
        $pending_application = collect($applications)->where('status', 1)->values();
        $approved_application = collect($applications)->where('status', 2)->values();
        $filed_application = collect($applications)->where('status', 3)->values();
        $initial_application = collect($applications)->where('appeal_no', 0)->values();
        $first_application = collect($applications)->where('appeal_no', 1)->values();
        $second_application = collect($applications)->where('appeal_no', 2)->values();

        $today_applications = RtiApplication::list(false, ['date' => Carbon::now()]);
        $lawyers = Lawyer::list(true, ['status' => true]);
        $close_request = ApplicationCloseRequest::list(false, ['status' => 0]);
        $close_request = collect($close_request )->where('status', 0)->values();
        return view('pages.dashboard', compact('initial_application', 'first_application', 'second_application' ,'today_applications', 'pending_application', 'approved_application', 'filed_application', 'applications', 'lawyers', 'close_request'));
    }
}
