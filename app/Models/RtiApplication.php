<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Jobs\SendEmail;

class RtiApplication extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'application_no', 'service_id', 'first_name', 'last_name', 'email', 'phone_number', 'address', 'postal_code', 'service_fields', 'charges', 'status', 'lawyer_id', 'payment_id', 'success_response', 'error_response', 'service_category_id', 'payment_status', 'payment_details', 'signature_type', 'signature_image', 'documents', 'application_id', 'appeal_no', 'pio_address', 'manual_pio', 'customer_pio_address', 'process_status', 'final_rti_document','invoice_number','invoice_path', 'city', 'state', 'pio_expected_date'];
    protected $casts = [
        'documents' => 'array'
    ];


    public static function list($pagination, $filters = null)
    {
        $filter_data = $filters;
        unset($filters['page']);
        // unset($filters['search']);
        unset($filters['service_id']);
        unset($filters['order_by']);
        unset($filters['order_by_type']);
        $filters = array_remove_null($filters);
        $order_by_key = $filter_data['order_by'] ?? 'id';
        $order_by_type = $filter_data['order_by_type'] ?? 'desc';

        $list = RtiApplication::with('service')->orderBy($order_by_key, $order_by_type)->where('process_status', true);
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                if ($filter != null) {
                    if ($key == 'email') {
                        $list->where('email', 'like', '%' . $filter . '%');
                    } elseif ($key == 'search') {
                        $list->where(function ($query) use ($filter) {
                            $query->where('application_no', 'like', "%" . $filter . "%")
                                ->orwhere('first_name', 'like', "%" . $filter . "%")
                                ->orwhere('last_name', 'like', "%" . $filter . "%")
                                ->orwhere('email', 'like', "%" . $filter . "%")
                                ->orwhere('phone_number', 'like', "%" . $filter . "%");
                        });
                    } elseif ($key == 'date') {
                        $list->wheredate('created_at', $filter);
                    } else {

                        $list->where($key, $filter);
                    }
                }
            }
        }

        if (isset($filter_data['service_id']) && !empty($filter_data['service_id'])) {
            $list->wherehas('service', function ($query) use ($filter_data) {
                $query->where('id', $filter_data['service_id']);
            });
        }
        if ($pagination) {
            return $list->paginate(20);
        } else {
            return $list->get();
        }
    }

    public static function get($id)
    {

        return RtiApplication::find($id);
    }

    public static function rtiNumberDetails($filter)
    {

        return RtiApplication::where($filter)->orderBy('appeal_no')->get();
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }

    public function lawyers()
    {
        return $this->belongsToMany(Lawyer::class, 'rti_application_lawyers', 'application_id', 'lawyer_id')->orderByPivot('created_at', 'desc');
    }

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }


    public function lastRevision()
    {
        return $this->hasOne(RtiApplicationRevision::class, 'application_id', 'id')->orderBy('id', 'desc');
    }


    public static function draftedApplication($data)
    {
        $revision = $data->lastRevision;
        if ($revision) {
            $field_data = json_decode($revision->details, true);
            $html = $revision->serviceTemplate->template;
            $signature_html = $revision->serviceTemplate->signature;

            foreach ($field_data as $key => $value) {
                $html = str_replace("[" . $key . "]", $value, $html);
                $signature_html = str_replace("[" . $key . "]", $value, $signature_html);

            }
            $html = str_replace("[pio_address]", $data->pio_address, $html);

            $signature_html = str_replace("[pio_address]", $data->pio_address, $signature_html);



            $signature = "";

            if ($data->signature_type != "manual" && !empty($data->signature_image)) {


                $signature = public_path($data->signature_image);
                $signature = "data:image/png;base64," . base64_encode(file_get_contents($signature));
            }
            if(!empty($data->signature_image)) {

                if($data->signature_type == 'manual') {
                    $signature_html = str_replace("[signature]", "<span>".$data->signature_image."</span>", $signature_html);
                }
                else {
                    $signature_html = str_replace("[signature]", " <img src=".$signature." alt='' width='100'>", $signature_html);
                }
               
            }
            $html = view('frontend.profile.rti-file-pdf', compact('data', 'field_data', 'revision', 'html', 'signature', 'signature_html'))->render();
            return $html;
        }
        return "";
    }

    public function courierTracking()
    {
        return $this->hasOne(RtiApplicationTracking::class, 'application_id', 'id');
    }

    public function lastRtiQuery()
    {
        return $this->hasOne(LawyerRtiQuery::class, 'application_id', 'id')->orderBy('id', 'desc');
    }


    public function rtiQueries()
    {
        return $this->hasMany(LawyerRtiQuery::class, 'application_id', 'id')->orderBy('id', 'desc');
    }

    public static function ApplicationPaymentInvoice($application,$fileName)
    {


        if ($application) {



            $company = Setting::getSettingData('invoice-setting');

            $paymentdata = json_decode($application->success_response, true);

            $logo = asset($company['invoice_logo'] ?? '');

            $signature = public_path($company['invoice_logo'] ?? '');
            $logo = "data:image/png;base64," . base64_encode(file_get_contents($signature));
         

            $pdf = PDF::loadView('frontend.profile.invoice', compact('company', 'application', 'paymentdata', 'logo'));

            // Set paper size to A4 (customize orientation if needed)
            $pdf->setPaper('A4', 'portrait');  // Or 'landscape' for landscape mode


            // $pdf->stream();
            // Define the path to the public folder directly
            $path = public_path('upload/pdf/' . $fileName);

            // Save the PDF to the public folder using File class
            File::put($path, $pdf->output());

            // Return the URL to the saved file
            $fileUrl = 'upload/pdf/' . $fileName;
            return   $fileUrl;
        }
    }

    public function closeRequest()
    {
        return $this->hasone(ApplicationCloseRequest::class, 'application_id', 'id')->where('lawyer_id', auth()->guard('lawyers')->id());
    }

    public function firstAppeal()
    {
        return $this->hasone(RtiApplication::class, 'application_no', 'application_no')->where('appeal_no', 1);
    }

    public function secondAppeal()
    {
        return $this->hasone(RtiApplication::class, 'application_no', 'application_no')->where('appeal_no', 2);
    }

    public function parentFirstAppeal()
    {
        return $this->hasone(RtiAppeal::class, 'application_id', 'application_id')->where('appeal_no', 1);
    }
    public function parentSecondAppeal()
    {
        return $this->hasone(RtiAppeal::class, 'application_id', 'application_id')->where('appeal_no', 2);
    }

    public function lawyerNotifications()
    {
        return $this->hasMany(Notification::class, 'linkable_id', 'id')->where(['linkable_type' => 'rti-application', 'to_type' => 'lawyer', 'to_id' => auth()->guard('lawyers')->id()]);
    }

    public function filedTime()
    {
        return $this->hasOne(ApplicationStatus::class, 'application_id', 'id')->where(['status' => 'filed']);
    }



    public static function razorPayResponse($payment_id)
    {

        $username = env('RAZORPAY_KEY');
        $password = env('RAZORPAY_SECRET');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payments/' . $payment_id);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

        $response = curl_exec($ch);

        curl_close($ch);
        return $response;
    }
}
