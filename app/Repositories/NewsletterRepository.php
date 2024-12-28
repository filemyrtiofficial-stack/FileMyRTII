<?php
namespace App\Repositories;
use App\Interfaces\NewsletterInterface;
use Carbon\Carbon;
use App\Models\Newsletter;
use Session;
use Exception;
class NewsletterRepository implements NewsletterInterface {

//     public function store($request) {
//         $service = Newsletter::create(['client_name' => $request['client_name'], 'image' => uploadFile($request, 'image', 'Newsletter'), 'status' => $request->status, 'comment' => $request->comment]);
//         Session::flash("success", "Data successfully added");
//         return response(['message' => "Data successfully added"]);
//     }
    
//     public function update($request, $id) {
//         $data = [
//             'client_name' => $request['client_name'],
//             'status' => $request->status, 
//             'comment' => $request->comment
//         ];

      
//         $image = uploadFile($request, 'image', 'Newsletter');
//         if(!empty($image)) {
//             $data['image'] = $image;
//         }
//         Newsletter::where('id', $id)->update($data);
//         Session::flash("success", "Data successfully updated");
//         return response(['message' => "Data successfully updated"]);
//     }


    public function delete($id) {
        $data = Newsletter::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid Newsletter type");

        }
    }

}