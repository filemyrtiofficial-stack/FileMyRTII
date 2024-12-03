<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Repositories\DoctorRepository;
use App\Interfaces\DoctorInterface;
use Validator;
use App\Models\Specialization;
use App\Http\Resources\HospitalResource;
use App\Models\Hospital;
use Exception;
class DoctorController extends Controller
{

    private DoctorRepository $doctorRepository;

    public function __construct(DoctorInterface $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors = Doctor::list(true, $request->all());

        return view('pages.doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hospitals = Hospital::list(false, ['status' => 1]);
        $specialization = Specialization::list(false, ['status' => 1]);

        return view('pages.doctors.create', compact('specialization', 'hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            'profile' => "required",
            'address' => "required",
            'city' => "required",
            'state' => "required",
            'country' => "required",
            'pincode' => "required",
            'qualification' => "required",
            'about' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->doctorRepository->store($request);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = Doctor::get($id);
        return view('pages.doctors.show', compact('data', 'request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $specialization = Specialization::list(false, ['status' => 1]);
        $hospitals = Hospital::list(false, ['status' => 1]);
        $data = Doctor::get($id);
        $specialization_ids = getIds($data->doctorSpecialization->toArray(), 'speciality_id');
        return view('pages.doctors.create', compact('specialization', 'data', 'specialization_ids', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => "required",
            // 'profile' => "required",
            'address' => "required",
            'city' => "required",
            'state' => "required",
            'country' => "required",
            'pincode' => "required",
            'qualification' => "required",
            'about' => "required",

        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->doctorRepository->update($request, $id);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
