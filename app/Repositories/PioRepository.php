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
        $data = $request->only(['name', 'email', 'phone_number', 'address', 'state', 'city', 'pincode', 'status']);
        $data['image'] = uploadFile($request, 'image', 'pio');
        $lawyer = PioMaster::create($data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = $request->only(['name', 'email', 'phone_number', 'address', 'state', 'city', 'pincode', 'status']);
        $image = uploadFile($request, 'image', 'lawyer');
        if(!empty($image)) {
            $data['image'] = $image;
        }
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