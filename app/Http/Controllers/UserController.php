<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\AuthRepository;
use App\Interfaces\AuthInterface;
use Validator;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
class UserController extends Controller
{
    private AuthRepository $authRepository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->middleware(['can:Manage User']);
        $this->middleware(['can:Delete User'], ['only' => ['destroy']]);
        $this->middleware(['can:Create User'], ['only' => ['create', 'store']]);
        $this->middleware(['can:Edit User'], ['only' => ['edit', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = User::list(true, $request->all());
        return view('pages.user.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $roles = Role::get();
        return view('pages.user.create', compact('roles'));
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
            'name' => "required|max:45|regex:/^[a-zA-Z\s.]+$/u",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|unique:users,email|max:45",
            'status' => "required",
            'role' => 'required'
        ]);
        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->store($request);
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
        $data = User::get($id);
        $roles = Role::get();

        return view('pages.user.create', compact('data', 'roles'));
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
            'name' => "required|regex:/^[a-zA-Z\s.]+$/u|max:45",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:250|unique:users,email,".$id,
            'status' => "required",
            'role' => 'required'

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->update($request, $id);
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
            $data = $this->authRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
    
    public function myProfile() {
        $data = auth()->user();

        return view('pages.user.my-profile', compact('data'));

    }
    public function updateProfile(Request $request)
    {
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [
            'name' => "required|regex:/^[a-zA-Z\s.]+$/u|max:45",
            'email' => "required|email|regex:/(.+)@(.+)\.(.+)/i|max:200|unique:users,email,".$id,

        ]);

        if($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }
        $data = $this->authRepository->update($request, $id);
        return $data;
    }

}
