<?php
namespace App\Repositories;
use App\Interfaces\RoleInterface;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Exception;
use DB;
class RoleRepository implements RoleInterface {

    public function store($request) {
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request['name'], 'guard' => 'web']);
            $role->syncPermissions($request->permissions);
            Session::flash("success", "Data successfully added");
            DB::commit();
            return response(['message' => "Data successfully added", 'redirect' => route('roles.index')]);
        } catch (\Throwable $th) {
            DB::rollback();
            return response(['message' => $th->getMessage()], 500);

        }
    }
    
    public function update($request, $id) {
        $role = Role::where('id', $id)->first();
        $role->update(['name' => $request['name']]);
        $role->syncPermissions($request->permissions);

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Role::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid Role type");

        }
    }


}