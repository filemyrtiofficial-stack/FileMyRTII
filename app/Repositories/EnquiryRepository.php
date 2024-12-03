<?php
namespace App\Repositories;
use App\Interfaces\EnquiryInterface;
use Carbon\Carbon;
use App\Models\Enquiry;
use Session;
use Exception;
class EnquiryRepository implements EnquiryInterface {


    public function delete($id) {
        $data = Enquiry::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid enquiry");

        }
    }

}