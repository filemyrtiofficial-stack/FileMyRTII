<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Repositories\LawyerRepository;
use App\Interfaces\LawyerInterface;
use Validator;
use Carbon\Carbon;
class LawyerController extends Controller
{

    private LawyerRepository $lawyerRepository;

    public function __construct(LawyerInterface $lawyerRepository)
    {
        $this->lawyerRepository = $lawyerRepository;
        $this->middleware(['can:Manage Lawyer']); 
        $this->middleware(['can:Delete Lawyer'], ['only' => ['destroy']]); 
        $this->middleware(['can:Create Lawyer'], ['only' => ['create', 'store']]); 
        $this->middleware(['can:Edit Lawyer'], ['only' => ['edit', 'update']]); 

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Lawyer::list(true, $request->all());
        return view('pages.lawyers.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.lawyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'first_name' => "required",
            'dob' => "required|date|before:".Carbon::now()->subYear('10')->format('Y-m-d'),
            'phone' => "required|numeric|digits:10",
            'email' => "required|email|unique:lawyers,email|regex:/@filemyrti\.com$/",
            'status' => "required",
            'qualification' => "required",
            'image' => "required|image",
            // 'experience' => "required|numeric",
            'address' => "required",
            'alternative_phone_no' => 'numeric|digits:10',
            'personal_email_id' => 'email',
            'bank_account_number' => 'numeric'

        ]);
      
     
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->lawyerRepository->store($request);
        return $data;
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
        $data = Lawyer::get($id);
        return view('pages.lawyers.create', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'first_name' => "required",
            'dob' => "required|date|before:".Carbon::now()->subYear('10')->format('Y-m-d'),
            'phone' => "required|numeric|digits:10",
            'email' => "required|email|unique:lawyers,email,".$id."|regex:/@filemyrti\.com$/",
            'status' => "required",
            'qualification' => "required",
            'image' => "nullable|image",
            // 'experience' => "required|numeric",
            'address' => "required",
            'alternative_phone_no' => 'nullable|numeric|digits:10',
            'personal_email_id' => 'email',
            'bank_account_number' => 'numeric'

        ]);
        
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->lawyerRepository->update($request, $id);
        return $data;
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
            $data = $this->lawyerRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
}
