<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lab;
use App\Models\LabTest;
use App\Repositories\LabRepository;
use App\Interfaces\LabInterface;
use Validator;
use App\Models\Specialization;
use App\Http\Resources\LabResource;
use Exception;
class LabController extends Controller
{

    private LabRepository $labRepository;

    public function __construct(LabInterface $labRepository)
    {
       $this->labRepository = $labRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = Lab::list(true, $request->all());

        return view('pages.labs.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lab_tests = LabTest::list(false, ['status' => 1]);

        return view('pages.labs.create', compact('lab_tests'));

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
        $data =$this->labRepository->store($request);
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
        $data = Lab::get($id);

        return view('pages.labs.show', compact('data', 'request'));
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
        $data = Lab::get($id);
        $specialization_ids = getIds($data->LabSpecialization->toArray(), 'speciality_id');
        return view('pages.labs.create', compact('specialization', 'data', 'specialization_ids'));
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
        $data =$this->labRepository->update($request, $id);
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
            $data =$this->labRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
}