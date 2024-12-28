<?php
namespace App\Repositories;
use App\Interfaces\DoctorInterface;
use Carbon\Carbon;
// use App\Models\MemberMedicalHistory;
use App\Models\Doctor;
use App\Models\DoctorSpeciality;
use App\Models\DoctorHospital;
use App\Models\DoctorHospitalTime;
use Exception;
use App\models\DoctorTiming;
class DoctorRepository implements DoctorInterface {

    public function store($request) {
        // uploadFile
        $data = $request->only([ 'name', 'address', 'city', 'state', 'country', 'pincode', 'email_id', 'contact_no', 'status', 'experience', 'dob', 'fee','about', 'qualification']);
        $image = uploadFile($request, 'profile', 'doctor');
        if(!empty($image)) {
            $data['profile'] = $image;
        }
        $doctor = Doctor::create($data);
        $doctor->update(['code' => 'DOC-'.$doctor->id]);
        if($doctor) {
            $this->updateDoctorHospital($doctor, $request);
            $this->updateDoctorSpecialization($doctor, $request);
        }
        session()->flash('success', "Data successfully added");
        return response(['message' => "Data successfully added"]);

    }

    private function updateDoctorHospital($doctor, $request) {
        $requested_data = $request->all();
        if($doctor->doctorHospitals) {
            foreach($doctor->doctorHospitals as $doctor_hospital) {
                $doctor_hospital->hospitaTimes()->delete();
                $doctor_hospital->hospitaTiming()->delete();
            }
            $doctor->doctorHospitals()->delete();
            
        }

        if(isset($requested_data['hospital'])) {

            for($index = 0; $index < count($requested_data['hospital']); $index++) {
                $timing = [];
                $day_data = [
                    'sunday' => [], 
                    'monday' => [], 
                    'tuesday' => [], 
                    'wednesday' => [], 
                    'thursday' => [], 
                    'friday' => [], 
                    'saturday' => [] 
                ];
               
                if(isset($requested_data[$index.'_day'])) {
                    for($day_index = 0; $day_index < count($requested_data[$index.'_day']); $day_index++) {
                        if(!empty($requested_data[$index.'_day'][$day_index]) && !empty($requested_data[$index.'_start_time'][$day_index]) && !empty($requested_data[$index.'_end_time'][$day_index])) {
                            array_push($timing, [
                                'day' => $requested_data[$index.'_day'][$day_index],
                                'start_time' => $requested_data[$index.'_start_time'][$day_index],
                                'end_time' => $requested_data[$index.'_end_time'][$day_index]
                            ]);
                            array_push($day_data[$requested_data[$index.'_day'][$day_index]], [
                                'start_time' => $requested_data[$index.'_start_time'][$day_index],
                                'end_time' => $requested_data[$index.'_end_time'][$day_index]
                            ]);
                        }
                    }
                }

                $hospital = DoctorHospital::create([
                    'doctor_id' => $doctor->id,
                    'hospital_id' => $requested_data['hospital'][$index],
                    'times' => json_encode($timing)
                ]);

                foreach($day_data as $key => $value) {
                    if(!empty($value)) {
                        DoctorHospitalTime::create([
                            'doctor_hospital_id' => $hospital->id,
                            'day_number' => dayList()[$key] ?? '',
                            'day' => $key,
                            'times' => json_encode($value)
                        ]);
                        foreach($value as $item) {
                            DoctorTiming::create([
                             'doctor_hospital_id' => $hospital->id,
                            'day_number' => dayList()[$key] ?? '',
                            'day' => $key,
                            'start_time' => $item['end_time'],
                            'end_time' => $item['start_time']
                            ]);
                        }
                    }
                }
            }
        }
    }

    

    private function updateDoctorSpecialization($doctor, $request) {
        $requested_data = $request->all();
        if($doctor->doctorSpecialization) {
            $doctor->doctorSpecialization()->delete();
        }
        if(isset($requested_data['specilities'])) {

            for($index = 0; $index < count($requested_data['specilities']); $index++) {
               
                if(!empty($requested_data['specilities'][$index])) {
                    // print_r(json_encode($requested_data));die;
                    $time = DoctorSpeciality::create([
                        'speciality_id' => $requested_data['specilities'][$index],
                        'doctor_id' => $doctor->id
                    ]);
                }
            }
        }
    }

   

    public function update($request, $id) {
        $doctor = Doctor::find($id);
        $data = $request->only([ 'name', 'address', 'city', 'state', 'country', 'pincode', 'email_id', 'contact_no', 'status', 'experience', 'dob', 'fee','about', 'qualification']);
        $image = uploadFile($request, 'profile', 'doctor');
        if(!empty($image)) {
            $data['profile'] = $image;
        }
        if(!empty($doctor->code)) {
            $data['code'] = "Doc-".$doctor->id;
        }
        $doctor->update($data);
         $this->updateDoctorHospital($doctor, $request);
         $this->updateDoctorSpecialization($doctor, $request);
         session()->flash('success', "Data successfully updated");
        return response(['message' => "Data successfully updated"]);

 
    }


    public function delete($id) {
        
        $doctor = Doctor::find($id);
        if($doctor) {
            if($doctor->doctorHospitals) {
                foreach($doctor->doctorHospitals as $doctor_hospital) {
                    $doctor_hospital->times()->delete();
                }
                $doctor->doctorHospitals()->delete();
                
            }
            if($doctor->doctorSpecialization) {
                $doctor->doctorSpecialization()->delete();
            }
            
            $doctor->delete();
            return true;
        }
        else {
            throw new Exception("Invalid doctor");
        }
    }

    

}