<?php
namespace App\Repositories;
use App\Interfaces\PioInterface;
use Carbon\Carbon;
use App\Models\PioMaster;
use App\Models\SlugMaster;

use Session;
use Exception;
class PioRepository implements PioInterface {

    public function store($request) {
        $data = $request->only([ 'address']);
        // $data = $request->only(['state', 'pincode', 'mandal', 'tahsildar', 'department', 'city']);
        // $data['address'] = $this->setAddressAttribute($data);
        $lawyer = PioMaster::create($data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }


    public function setAddressAttribute($data)
    {
    	return "Mandal Revenue Office , ".$data['mandal'].", ".$data['city'].", ".$data['state']." - ".$data['pincode'].", India";
    }
    
    public function update($request, $id) {
        // $data = $request->only(['state', 'pincode', 'mandal', 'tahsildar', 'department', 'city']);
        // $data['address'] = $this->setAddressAttribute($data);
        $data = $request->only([ 'address']);
        PioMaster::where('id', $id)->update($data);

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = PioMaster::where(['id' => $id])->first();
        if($data) {
           
            $data->delete();
        }
        else {
            throw new Exception("Invalid pio");

        }
    }

}