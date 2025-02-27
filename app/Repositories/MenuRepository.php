<?php
namespace App\Repositories;
use App\Interfaces\MenuInterface;
use Carbon\Carbon;
use App\Models\MenuSetting;
use Session;
use Exception;
class MenuRepository implements MenuInterface {

    public function store($request) {

        if ($request->status==1) {
            if ($request->position == 'header') {
                MenuSetting::where('position',$request->position)->update(['status'=>0]);
            }
        }
        $men=new MenuSetting;
        $men->name=$request->name;
        $men->position=$request->position;
        $men->status=$request->status;
        $men->data="[]";
        $men->save();

        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }

    public function update($request, $id) {
        if ($request->status==1) {
            if ($request->position == 'header') {
                    MenuSetting::where('position',$request->position)->update(['status'=>0]);
            }
        }

        $men= MenuSetting::find($id);
        $men->name=$request->name;
        $men->position=$request->position;
        $men->status=$request->status;
        $men->save();

        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }




    public function delete($id) {
        $data = MenuSetting::where(['id' => $id])->first();
        if($data) {

            $data->delete();
        }
        else {
            throw new Exception("Invalid diease type");

        }
    }

    public function updateNode($request) {
        $info= MenuSetting::find($request->menu_id);
        $info->data=$request->data;
        $info->save();
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);

    }


}
