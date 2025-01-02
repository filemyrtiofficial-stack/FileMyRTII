<?php
namespace App\Repositories;
use App\Interfaces\LabInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\Lab;
use App\Models\LabTime;
use App\Models\LabGallery;
use App\Models\LabTestList;
use Exception;
use Session;
class LabRepository implements LabInterface {

    public function store($request) {
        // uploadFile
        $data = $request->only(['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'contact_person']);
        $lab = Lab::create($data);
        if($lab) {
            
            // echo "test";die;
            $this->updateLabTime($lab, $request);
            $this->updateLabTest($lab, $request);

            // primary_image
            $image = uploadFile($request, 'primary_image', 'lab');
            if(!empty($image)) {
                LabGallery::create(['lab_id' => $lab->id, 'is_primary' => 1, 'image' => $image]);
            }

            $image_list = multipleFiles($request, 'galleries', 'lab');
            foreach($image_list as $image) {
                LabGallery::create(['lab_id' => $lab->id, 'is_primary' => 0, 'image' => $image]);

            }

        }
        Session::flash("success", "Data successfully added");
        
    }

    private function updateLabTime($lab, $request) {
        $requested_data = $request->all();
        if($lab->labTimes) {
            $lab->labTimes()->delete();
        }
        if(isset($requested_data['day'])) {

            for($index = 0; $index < count($requested_data['day']); $index++) {
               
                if(!empty($requested_data['day'][$index]) && !empty($requested_data['opening_time'][$index]) && !empty($requested_data['closing_time'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = LabTime::create([
                        'day' => $requested_data['day'][$index],
                        'day_number' => dayList()[$requested_data['day'][$index]],
                        'opening_time' => $requested_data['opening_time'][$index],
                        'closing_time' => $requested_data['closing_time'][$index],
                        'lab_id' => $lab->id
                    ]);
                }
            }
        }
    }

    

    private function updateLabTest($lab, $request) {
        $requested_data = $request->all();
        if($lab->labTestList) {
            $lab->labTestList()->delete();
        }
        if(isset($requested_data['lab_tests'])) {

            for($index = 0; $index < count($requested_data['lab_tests']); $index++) {
               
                if(!empty($requested_data['lab_tests'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = LabTestList::create([
                        'lab_test_id' => $requested_data['lab_tests'][$index],
                        'lab_id' => $lab->id
                    ]);
                }
            }
        }
    }

   
    

    public function update($request, $id) {
         // uploadFile
         $data = $request->only(['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'contact_person']);
         $lab = Lab::find($id);
         $lab->update($data);
            
         $this->updateLabTime($lab, $request);
         $this->updateLabTest($lab, $request);
        
        // primary_image
        $image = uploadFile($request, 'primary_image', 'lab');
        if(!empty($image)) {
            $check_image = HospitalGallery::where(['lab_id' => $lab->id, 'is_primary' => 1])->first();
            if($check_image) {
                $check_image->update(['image' => $image]);
            }
            else {
                LabGallery::create(['lab_id' => $lab->id, 'is_primary' => 1, 'image' => $image]);
            }

        }

        $image_list = multipleFiles($request, 'galleries', 'lab');
        foreach($image_list as $image) {
            LabGallery::create(['lab_id' => $lab->id, 'is_primary' => 0, 'image' => $image]);

        }
 
    }


    public function delete($id) {
        
        $hospital = Hospital::find($id);
        if($hospital) {
            if($hospital->hospitalTimes) {
                $hospital->hospitalTimes()->delete();
            }
            if($hospital->hospitalSpecialization) {
                $hospital->hospitalSpecialization()->delete();
            }
            if($hospital->hospitalContactPerson) {
                $hospital->hospitalContactPerson()->delete();
            }
            if($hospital->hospitalPrimaryImage) {
                $hospital->hospitalPrimaryImage()->delete();
            }
            if($hospital->hospitalGalleryImage) {
                $hospital->hospitalGalleryImage()->delete();
            }
            if($hospital->ambulances) {
                $hospital->ambulances()->delete();
            }
            
            $hospital->delete();
            return true;
        }
        else {
            throw new Exception("Invalid hospital");
        }
    }

    

}