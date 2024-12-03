<?php
namespace App\Repositories;
use App\Interfaces\CategoryInterface;
use Carbon\Carbon;
use App\Models\Category;
use Session;
use Exception;
class CategoryRepository implements CategoryInterface {

    public function store($request) {
        Category::create(['name' => $request['name'],  'status' => $request->status]);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added"]);
    }
    
    public function update($request, $id) {
        $data = [
            'name' => $request['name'],
            'status' => $request->status
        ];
        Category::where('id', $id)->update($data);
        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated"]);
    }
    

   

    public function delete($id) {
        $data = Category::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid category");

        }
    }

}