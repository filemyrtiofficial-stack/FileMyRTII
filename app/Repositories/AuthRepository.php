<?php
namespace App\Repositories;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Carbon\Carbon;
use Session;
class AuthRepository implements AuthInterface {

    public function store($request) {
        $data = $request->only(['email', 'password', 'status']);
        $data['username'] = $request->name;
        $user = User::create($data);
        $user->assignRole($request->role);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = $request->only(['email', 'status', 'password']);
        $data['username'] = $request->name;

        $user = User::where('id', $id)->first();
        $user->update($data);
        $user->assignRole($request->role);

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = User::where(['id' => $id])->first();
        if($data) {
            if( $data->username == 'admin') {
            throw new Exception("Your can't delete this user");

            }
           
            $data->delete();
        }
        else {
            throw new Exception("Invalid user");

        }
    }


}