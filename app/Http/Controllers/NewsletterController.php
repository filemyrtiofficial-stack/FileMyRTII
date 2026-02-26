<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use App\Repositories\NewsletterRepository;
use App\Interfaces\NewsletterInterface;
use Validator;
use App\Exports\NewsletterExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:Manage Newsletter Data']); 

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Newsletter::list(true, $request->all());
        return view('pages.newsletter.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          try {
             $data = Newsletter::where(['id' => $id])->first();
            if ($data) {
    
                $data->delete();
            } else {
                throw new Exception("Invalid Newsletter");
            }
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
     public function newsletterExport(Request $request) {
          $query = Newsletter::query();

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
    
        $users = $query->get(['email', 'created_at']); // only needed columns
    
        // Create CSV content
        $csv = fopen('php://temp', 'r+');
        fputcsv($csv, ['Email', 'Created At']); // headers
    
        foreach ($users as $user) {
            fputcsv($csv, [$user->email, $user->created_at]);
        }
    
        rewind($csv);
        $csvContent = stream_get_contents($csv);
        fclose($csv);
    
        // Return CSV download
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="newsletter.csv"',
        ]);
        return Excel::download(new NewsletterExport($request->all()), 'newsletter.xlsx');
    }
}
