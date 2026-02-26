<?php
namespace App\Repositories;
use App\Interfaces\AuthInterface;
use App\Models\User;
use Carbon\Carbon;
use Session;
use App\Models\Customer;
use App\Models\MailTemplate;
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
        $data = $request->only(['email', 'status']);
        if(!empty($request->password)) {
            $data['password'] = $request->password;
        }
        $data['username'] = $request->name;

        $user = User::where('id', $id)->first();
        $user->update($data);
        $user->syncRoles($request->role);

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
    
    public function updateProfile($request, $id) {
        $data = $request->only(['email', 'status']);
        if(!empty($request->password)) {
            $data['password'] = $request->password;
        }
        $data['username'] = $request->name;

        $user = User::where('id', $id)->first();
        $user->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    
    
    public function customerUpdate($request, $id) {
        $data = $request->only(['email', 'first_name', 'last_name', 'phone_no']);
        $user = Customer::where('id', $id)->first();
        $user->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    
      public function createUpdateTemplate($request, $id = null) {
        if($id == null) {
            MailTemplate::create(['name' => $request->name, 'html' => $request->template, 'subject' => $request->subject]);
            Session::flash("success", "Data successfully added");
            return response(['message' => "Data successfully added"]);
        }
        else {
            MailTemplate::where('id', $id)->update(['name' => $request->name, 'html' => $request->template, 'subject' => $request->subject]);
            Session::flash("success", "Data successfully updated");
            return response(['message' => "Data successfully updated"]);

        }
    }


}