<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PioMaster;
use App\Repositories\PioRepository;
use App\Interfaces\PioInterface;
use Validator;
use Carbon\Carbon;
use App\Imports\PioImport;
use Maatwebsite\Excel\Facades\Excel;

class PioController extends Controller
{
    private PioRepository $pioRepository;

    public function __construct(PioInterface $pioRepository)
    {
        $this->pioRepository = $pioRepository;
        $this->middleware(['can:Manage PIO']);
        $this->middleware(['can:Delete PIO'], ['only' => ['destroy']]);
        $this->middleware(['can:Create PIO'], ['only' => ['create', 'store']]);
        $this->middleware(['can:Edit PIO'], ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = PioMaster::list(true, $request->all());
        return view('pages.pio-master.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('pages.pio-master.create');
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
            // 'state' => "required",
            // 'pincode' => "required|numeric|digits:6",
            'address' => "required",
            // 'department' => "required",
            // 'mandal' => "required"


        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->pioRepository->store($request);
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
        $data = PioMaster::get($id);

        return view('pages.pio-master.create', compact('data'));
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
            // 'state' => "required",
            // 'pincode' => "required|numeric|digits:6",
                'address' => "required",
            // 'department' => "required",
            // 'mandal' => "required"

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->pioRepository->update($request, $id);
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
            $data = $this->pioRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }

    public function searchPIO(Request $request) {
        $list = PioMaster::list(false, ['address' => $request->address]);

        return response(['data' => $list]);
    }


    public function importPio(Request $request){
        $request->validate([
            'file'=>'required|max:2024|mimes:csv',
        ]);

        Excel::import(new PioImport, $request->file('file'));
        return back()->with('success', 'File Imported Successfully!');
    }

}
