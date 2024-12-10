<?php
namespace App\Repositories;
use App\Interfaces\TestimonialInterface;
use Carbon\Carbon;
use App\Models\Testimonial;
use Session;
use Exception;
class TestimonialRepository implements TestimonialInterface {

    public function store($request) {
        $service = Testimonial::create(['client_name' => $request['client_name'], 'image' => uploadFile($request, 'image', 'testimonial'), 'status' => $request->status, 'comment' => $request->comment]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'client_name' => $request['client_name'],
            'status' => $request->status, 
            'comment' => $request->comment
        ];

      
        $image = uploadFile($request, 'image', 'testimonial');
        if(!empty($image)) {
            $data['image'] = $image;
        }
        Testimonial::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Testimonial::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid diease type");

        }
    }

}