<?php
namespace App\Repositories;
use App\Interfaces\HospitalInterface;
use Carbon\Carbon;
use App\Models\MemberMedicalHistory;
use App\Models\Hospital;
use App\Models\HospitalTime;
use App\Models\HospitalGallery;
use App\Models\HospitalContactPerson;
use App\Models\HospitalSpecialization;
use App\Models\Ambulance;
use Exception;
class HospitalRepository implements HospitalInterface {

    public function store($request) {
        // uploadFile
        $data = $request->only(['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'home_service']);
        $hospital = Hospital::create($data);
        if($hospital) {
            
            // echo "test";die;
            $this->updateHospitalTime($hospital, $request);
            $this->updateHospitalSpecialization($hospital, $request);
            $this->updateHospitalContactPeople($hospital, $request);
            $this->updateHospitalAmbulance($hospital, $request);

            // primary_image
            $image = uploadFile($request, 'primary_image', 'hospital');
            if(!empty($image)) {
                HospitalGallery::create(['hospital_id' => $hospital->id, 'is_primary' => 1, 'image' => $image]);
            }

            $image_list = multipleFiles($request, 'galleries', 'hospital');
            foreach($image_list as $image) {
                HospitalGallery::create(['hospital_id' => $hospital->id, 'is_primary' => 0, 'image' => $image]);

            }

        }
        Session::flash("success", "Data successfully added");
        
    }

    private function updateHospitalTime($hospital, $request) {
        $requested_data = $request->all();
        if($hospital->hospitalTimes) {
            $hospital->hospitalTimes()->delete();
        }
        if(isset($requested_data['day'])) {

            for($index = 0; $index < count($requested_data['day']); $index++) {
               
                if(!empty($requested_data['day'][$index]) && !empty($requested_data['opening_time'][$index]) && !empty($requested_data['closing_time'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = HospitalTime::create([
                        'day' => $requested_data['day'][$index],
                        'opening_time' => $requested_data['opening_time'][$index],
                        'closing_time' => $requested_data['closing_time'][$index],
                        'hospital_id' => $hospital->id,
                        'day_number' => dayList()[$requested_data['day'][$index]],
                    ]);
                }
            }
        }
    }

    

    private function updateHospitalSpecialization($hospital, $request) {
        $requested_data = $request->all();
        if($hospital->hospitalSpecialization) {
            $hospital->hospitalSpecialization()->delete();
        }
        if(isset($requested_data['specilities'])) {

            for($index = 0; $index < count($requested_data['specilities']); $index++) {
               
                if(!empty($requested_data['specilities'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = hospitalSpecialization::create([
                        'speciality_id' => $requested_data['specilities'][$index],
                        'hospital_id' => $hospital->id
                    ]);
                }
            }
        }
    }

    private function updateHospitalContactPeople($hospital, $request) {
        $requested_data = $request->all();
        if($hospital->hospitalContactPerson) {
            $hospital->hospitalContactPerson()->delete();
        }
        if(isset($requested_data['ambulance_contact_person_name'])) {

            for($index = 0; $index < count($requested_data['ambulance_contact_person_name']); $index++) {
               
                if(!empty($requested_data['ambulance_contact_person_name'][$index]) && !empty($requested_data['ambulance_contact_no'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = Ambulance::create([
                        'ambulance_no' => $requested_data['ambulance_no'][$index],
                        'contact_person' => $requested_data['ambulance_contact_person_name'][$index],
                        'contact_no' => $requested_data['ambulance_contact_no'][$index],
                        'hospital_id' => $hospital->id
                    ]);
                }
            }
        }
    }

    
    private function updateHospitalAmbulance($hospital, $request) {
        $requested_data = $request->all();
        if($hospital->hospitalContactPerson) {
            $hospital->hospitalContactPerson()->delete();
        }
        if(isset($requested_data['contact_person_name'])) {

            for($index = 0; $index < count($requested_data['contact_person_name']); $index++) {
               
                if(!empty($requested_data['contact_person_name'][$index]) && !empty($requested_data['contact_no'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = HospitalContactPerson::create([
                        'name' => $requested_data['contact_person_name'][$index],
                        'contact' => $requested_data['contact_no'][$index],
                        'hospital_id' => $hospital->id
                    ]);
                }
            }
        }
    }


    public function update($request, $id) {
         // uploadFile
         $data = $request->only(['name', 'address', 'city', 'state', 'country', 'pincode', 'latitude', 'longitude', 'contact_nos', 'email_id', 'status', 'home_service']);
         $hospital = Hospital::find($id);
         $hospital->update($data);
            
            // echo "test";die;
            $this->updateHospitalTime($hospital, $request);
            $this->updateHospitalSpecialization($hospital, $request);
            $this->updateHospitalContactPeople($hospital, $request);
            $this->updateHospitalAmbulance($hospital, $request);
            // primary_image
            $image = uploadFile($request, 'primary_image', 'hospital');
            if(!empty($image)) {
                $check_image = HospitalGallery::where(['hospital_id' => $hospital->id, 'is_primary' => 1])->first();
                if($check_image) {
                    $check_image->update(['image' => $image]);
                }
                else {
                    HospitalGallery::create(['hospital_id' => $hospital->id, 'is_primary' => 1, 'image' => $image]);
                }

            }

            $image_list = multipleFiles($request, 'galleries', 'hospital');
            foreach($image_list as $image) {
                HospitalGallery::create(['hospital_id' => $hospital->id, 'is_primary' => 0, 'image' => $image]);

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