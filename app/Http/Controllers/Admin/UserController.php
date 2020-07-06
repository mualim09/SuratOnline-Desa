<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\ActivityLog;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Activity;
use Hash;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = New User;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = 'uploads/' . auth()->user()->id . '/' . time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            $image->save(public_path($path));
            $user->photo = $path;
        }


        $user->sin = $request->sin;
        $user->name = $request->name;

        $password = $request->password ?? Carbon::parse($request->birth_date)->format('d-m-Y');
        $user->password = Hash::make($password); 

        $user->birth_place = $request->birth_place;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->marital_status = $request->marital_status;
        $user->profession = $request->profession;
        $user->save();

        Activity::add(['page' => 'Warga', 'description' => 'Menambah Data Warga: '. $request->name]);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success', 
            'message' => 'Menambahkan Warga Baru: '.$request->name
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $logs = ActivityLog::where([
            'user_type' => 'user',
            'user_id' => $user->id,
        ])->get();

        return view('admin.user.show', ['user' => $user, 'logs' => $logs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = 'uploads/' . auth()->user()->id . '/' . time() . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            $image->save(public_path($path));
            $user->photo = $path;
        }

        $user->sin = $request->sin;
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->birth_place = $request->birth_place;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->religion = $request->religion;
        $user->marital_status = $request->marital_status;
        $user->profession = $request->profession;
        $user->save();
        
        Activity::add(['page' => 'User', 'description' => 'Menmperbarui Data Warga: '. $user->name]);

        return redirect()->route('admin.users.index')->with([
            'status' => 'success', 
            'message' => 'Berhasil Memperbarui Data Warga: '.$request->name
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Activity::add(['page' => 'User', 'description' => 'Menghapus Data Warga: '. $user->name]);
        $user->delete();

        return back()->with(['status' => 'success', 'message' => 'Data Berhasil Dihapus!']);
    }
}
