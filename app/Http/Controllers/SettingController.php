<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SettingRepository;
use App\Interfaces\SettingInterface;
use Validator;
use Illuminate\Support\Str;
use App\Models\Setting;

class SettingController extends Controller
{
    private SettingRepository $settingRepository;

    public function __construct(SettingInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type = null)
    {
        $data = Setting::getSettingData($type);
        return view('pages.setting.'.$type, compact('data', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->type == 'payment') {
            $validator = Validator::make($request->all(), [
                'amount_type.*' => "required",
                'amount.*' => "required|numeric",
                'basic.*' => "required",
                'advance.*' => "required",

            ]);
        }
        else {

            $validator = Validator::make($request->all(), [
                'primary_logo' => "required",
                'secondary_logo' => "required",
                'footer_logo_tagline' => "required",
                'address' => "required",
                'email' => "required",
                'contact_no' => "required"
            ]);
        }
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->settingRepository->store($request);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
