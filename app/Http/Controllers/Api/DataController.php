<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\SpecialityRepository;
use App\Interfaces\SpecialityInterface;
use App\Models\Specialization;
use App\Http\Resources\SpecialityResource;
use App\Models\Doctor;
use App\Http\Resources\DoctorResource;
use App\Models\Hospital;
use App\Http\Resources\HospitalResource;
use App\Models\DiseaseType;
use App\Http\Resources\DiseaseTypeResource;
use App\Models\Disease;
use App\Http\Resources\DiseaseResource;
use App\Models\LabTest;
use App\Http\Resources\LabTestResource;
use Validator;

class DataController extends Controller
{
    private SpecialityRepository $specialityRepository;

    public function __construct(SpecialityInterface $specialityRepository)
    {
        $this->specialityRepository = $specialityRepository;
    }

    public function specialityList(Request $request) {
        $list = Specialization::list(false, ['status' => 1]);
        $list = SpecialityResource::collection($list);
        return response(['data' => $list]);

    }

    public function hospitalList(Request $request) {
        $validator = Validator::make($request->all(), [
            'latitude' => "required",
            'longitude' => "required"

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $request->merge(['status' => 1]);
        $list = Hospital::list(false, $request->all());
        $list = HospitalResource::collection($list);
        return response(['data' => $list]);

    }

    public function doctorList(Request $request) {
        $request->merge(['status' => 1]);
        $list = Doctor::list(false, $request->all());
        $list = DoctorResource::collection($list);
        return response(['data' => $list]);

    }
    public function diseaseTypeList(Request $request) {
        $request->merge(['status' => 1]);
        $list = DiseaseType::list(false, $request->all());
        $list = DiseaseTypeResource::collection($list);
        return response(['data' => $list]);

    }

    public function getDiseaseType($id) {
        $list = DiseaseType::get($id);
        $list = new DiseaseTypeResource($list);
        return response(['data' => $list]);

    }

    public function dashboard() {
        $specialities = Specialization::list(false, ['status' => 1]);
        $specialities = SpecialityResource::collection($specialities);

        $dieases_types = DiseaseType::list(false, ['status' => 1]);
        $dieases_types = DiseaseTypeResource::collection($dieases_types);

        $dieases = Disease::list(false, ['status' => 1]);
        $dieases = DiseaseResource::collection($dieases);
        
        $lab_tests = LabTest::list(false, ['status' => 1]);
        $lab_tests = LabTestResource::collection($lab_tests);
        
        $recommended_doctors = Doctor::list(false, ['status' => 1]);
        $recommended_doctors = DoctorResource::collection($recommended_doctors);
        return response(['specialities' => $specialities, 'dieases_types' => $dieases_types, 'dieases' => $dieases, 'lab_tests' => $lab_tests, 'recommended_doctors' => $recommended_doctors]);

    }

    public function labTest(Request $request) {
        $list = LabTest::list(false, ['status' => 1]);
        $list = LabTestResource::collection($list);
        return response(['data' => $list]);

    }

    
}