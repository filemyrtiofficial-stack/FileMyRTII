<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Validator;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthInterface;
use Illuminate\Support\Facades\Response;
use App\Models\MailTemplate;
use Session;
use App\Jobs\SendEmail;
class CustomerController extends Controller
{


     private AuthRepository $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
   
        $this->middleware(['can:Manage Customer']); 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_data = $request->all();
        $current_page =  $filter_data['page'] ?? 1;

        $list = Customer::list(true, $request->all());
        if(isset($request['operation']) && $request['operation'] == 'filter') {
            $html = view('pages.customers.list', compact('list'))->render();


            $pagination = view('pages.customers.pagination', compact('list'))->render();
            $edit_form = view('pages.customers.edit-popup', compact('list'))->render();

            return response(['html' => $html, 'pagination' => $pagination, 'edit_form' => $edit_form]);
        }
         $mail_template = [];
        if(isset($request->mail_template) && !empty($request->mail_template)) {
            $mail_template = MailTemplate::find(decryptString($request->mail_template));
        }
        return view('pages.customers.index', compact('list', 'mail_template'));
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
        $data = Customer::get($id);

        return view('pages.customers.show', compact('data'));
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
        $validator = Validator::make($request->all(), [
            'first_name' => "required|regex:/^[a-zA-Z\s.]+$/u|max:45",
            'last_name' => "nullable|regex:/^[a-zA-Z\s.]+$/u|max:45",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:200|unique:customers,email,".$id,
            'phone_no' => "required",

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->customerUpdate($request, $id);
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
        //
    }
    public function export(Request $request) {
       $users =  Customer::list(false, $request->all());
  
      // Create CSV content
      $csv = fopen('php://temp', 'r+');
      fputcsv($csv, ['First Name', 'Last Name', 'Phone No.', 'Email', 'Created At']); // headers
  
      foreach ($users as $user) {
          fputcsv($csv, [$user->first_name, $user->last_name, $user->phone_no, $user->email, $user->created_at]);
      }
  
      rewind($csv);
      $csvContent = stream_get_contents($csv);
      fclose($csv);
  
      // Return CSV download
      return Response::make($csvContent, 200, [
          'Content-Type' => 'text/csv',
          'Content-Disposition' => 'attachment; filename="customers.csv"',
      ]);
  }
  
  
    public function mailTemplateIndex(Request $request) {
            $list = MailTemplate::list(true, $request->all());
            return view('pages.customers.mail-template.index', compact('list'));

    }
    public function mailTemplateStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:mail_templates,name",
            'subject' => "required",
            'template' => "required",

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->createUpdateTemplate($request);
        return $data;
    }

    public function mailTemplateUpdate(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => "required|unique:mail_templates,name,".$id,
            'subject' => "required",
            'template' => "required",

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->createUpdateTemplate($request, $id);
        return $data;
    }



    public function sendMail(Request $request) {
        if(!isset($request['ids']) || count($request['ids']) == 0) {
            Session::flash('mail-error', 'Please select atleast one user');
        }
        else {

            SendEmail::dispatch('promotion-mail', ['mail_template' => decryptString($request->mail_template), 'customers' => $request->ids]);
            Session::flash('mail-success', 'Mail are in process');
        
        }

        return back();
    }


}
