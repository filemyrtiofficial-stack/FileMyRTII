<?php
namespace App\Repositories;
use App\Interfaces\SettingInterface;
use Carbon\Carbon;
use App\Models\Setting;
use Session;
use Exception;
class SettingRepository implements SettingInterface {

    public function store($request) {
        $setting = Setting::where(['type' => $request->type])->first();
        if($setting) {
            $setting->update(['data' => json_encode($request->all())]);
        }
        else {
            Setting::create(['type' => $request->type, 'data' => json_encode($request->all())]);
        }
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
   

}