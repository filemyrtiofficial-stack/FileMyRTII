<?php
namespace App\Repositories;
use App\Interfaces\TeamMemberInterface;
use Carbon\Carbon;
use App\Models\TeamMember;
use App\Models\SlugMaster;

use Session;
use Exception;
class TeamMemberRepository implements TeamMemberInterface {

    public function store($request) {
        $team_members = TeamMember::create(['name' => $request['name'], 'image' => uploadFile($request, 'profile_image', 'profile_image'), 'status' => $request->status, 'about' => $request->about, 'expertise' => $request->expertise]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status,
            'about' =>  $request['about'],
            'expertise' => $request['expertise']
        ];
      
        $image = uploadFile($request, 'profile_image', 'profile_image');
        if (!empty($image)) {
           
            $data['image'] = $image;
        }
        else {
            if(isset($request['profile_image_preview'])&& !empty($request['profile_image_preview'])) {
                $data['image'] =$request['profile_image_preview'];
            }
            else {
                $data['image'] = null;
            }
        }
        TeamMember::where('id', $id)->update($data);

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = TeamMember::where(['id' => $id])->first();
        if($data) {
           
            $data->delete();
        }
        else {
            throw new Exception("Invalid diease type");

        }
    }

}