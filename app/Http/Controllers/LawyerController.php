<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lawyer;
use App\Repositories\LawyerRepository;
use App\Interfaces\LawyerInterface;
use Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Response;

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
        
        if(!isset($request->daterange)) {
           
            $request->merge(['daterange' => "01/01/2023 - ".Carbon::now()->addDay()->format('m/d/Y')]);
        }
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
            'first_name' => "required|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'last_name' => "nullable|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'dob' => "required|date|before:".Carbon::now()->subYear('10')->format('Y-m-d'),
            'phone' => "required|numeric|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
            // 'email' => "required|email|unique:lawyers,email|regex:/@filemyrti\.com$/",
            'email' => "required|email|unique:lawyers,email",
            'status' => "required",
            'qualification' => "required",
            'image' => "required|image",
            // 'experience' => "required|numeric",
            'address' => "required",
            'alternative_phone_no' => 'numeric|digits:10',
            'personal_email_id' => 'email|regex:/(.+)@(.+)\.(.+)/i',
            'bank_account_number' => 'numeric|digits_between:8,16',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ],[
            'phone.digits' => "Please enter a valid 10-digit phone number.",
            'phone.regex' => "Phone number should be started with 6, 7, 8 and 9"
        ]);
      


        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        if(!empty($request->bank_account_number) && (strlen($request->bank_account_number) < 8 || strlen($request->bank_account_number) > 16 )) {
                return response(['errors' => ['bank_account_number' => 'Account number length should be between 8 to 16']], 422);
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
            'first_name' => "required|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'last_name' => "nullable|max:50|regex:/^[a-zA-Z\s.]+$/u",
            'dob' => "required|date|before:".Carbon::now()->subYear('10')->format('Y-m-d'),
            'phone' => "required|numeric|digits:10|".Rule::notIn(['6666666666', '7777777777', '8888888888', '9999999999'])."|regex:/^[6789]\d{9}$/",
            // 'email' => "required|email|unique:lawyers,email,".$id."|regex:/@filemyrti\.com$/",
              'email' => "required|email|unique:lawyers,email,".$id,
            'status' => "required",
            'qualification' => "required",
            // 'image' => "nullable|image",
            // 'experience' => "required|numeric",
            'address' => "required",
            'alternative_phone_no' => 'nullable|numeric|digits:10',
            'personal_email_id' => 'email|regex:/(.+)@(.+)\.(.+)/i',
            'bank_account_number' => 'numeric|digits_between:8,16',
               'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ],[
            'phone.digits' => "Please enter a valid 10-digit phone number.",
            'phone.regex' => "Phone number should be started with 6, 7, 8 and 9"
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
     public function export(Request $request) {
        
        $users =  Lawyer::list(false, $request->all());
   
       // Create CSV content
       $csv = fopen('php://temp', 'r+');
       fputcsv($csv, ['First Name', 'Last Name', 'Phone No.', 'Email', 'Total Rti', 'Filed RTI', 'Pending RTI', 'Created At']); // headers
   
       foreach ($users as $user) {
           fputcsv($csv, [$user->first_name, $user->last_name, $user->phone, $user->email, $user->rti_applications_count ?? 0, $user->filed_rti_count ?? 0, $user->pending_rti_count ?? 0, $user->created_at]);
       }
   
       rewind($csv);
       $csvContent = stream_get_contents($csv);
       fclose($csv);
   
       // Return CSV download
       return Response::make($csvContent, 200, [
           'Content-Type' => 'text/csv',
           'Content-Disposition' => 'attachment; filename="lawyer.csv"',
       ]);
   }
}
