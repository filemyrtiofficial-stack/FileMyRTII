<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use App\Repositories\HospitalRepository;
use App\Interfaces\HospitalInterface;
use Validator;
use App\Models\Specialization;
use App\Http\Resources\HospitalResource;
use Exception;
class HospitalController extends Controller
{

    private HospitalRepository $hospitalRepository;

    public function __construct(HospitalInterface $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $hospitals = Hospital::list(true, $request->all());

        return view('pages.hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $specialization = Specialization::list(false, ['status' => 1]);

        return view('pages.hospitals.create', compact('specialization'));

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
            'primary_image' => "required",
            'name' => "required",
            'address' => "required",
            'city' => "required",
            'state' => "required",
            'country' => "required",
            'pincode' => "required",
            'latitude' => "required",
            'longitude' => "required",
            'days.*' => 'required',
            'opening_time.*' => 'required',
            'closing_time.*' => 'required'


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->hospitalRepository->store($request);
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
        $data = Hospital::get($id);

        return view('pages.hospitals.show', compact('data', 'request'));
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
        $data = Hospital::get($id);
        $specialization_ids = getIds($data->hospitalSpecialization->toArray(), 'speciality_id');
        return view('pages.hospitals.create', compact('specialization', 'data', 'specialization_ids'));
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
            // 'primary_image' => "required",
            'name' => "required",
            'address' => "required",
            'city' => "required",
            'state' => "required",
            'country' => "required",
            'pincode' => "required",
            'latitude' => "required",
            'longitude' => "required",
            'days.*' => 'required',
            'opening_time.*' => 'required',
            'closing_time.*' => 'required'


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->hospitalRepository->update($request, $id);
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
        try {
            $data = $this->hospitalRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
}