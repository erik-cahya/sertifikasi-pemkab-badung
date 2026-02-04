<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataUser'] = User::orderBy('roles', 'DESC')->get();
        return view('admin-panel.user-management.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'roles' => 'required',
            'password' => 'required|confirmed|min:4',

        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'roles' =>  strtolower(trim($request->roles)),
            'is_active' => 1,
        ]);

        $flashData = [
            'title' => 'Add New User Success',
            'message' => 'New User Data Listed',
            'swalFlashIcon' => 'success',
        ];
        return redirect()->route('user-management.index')->with('flashData', $flashData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => 'required|unique:users,name,' . $id . ',id',
            'email' => 'required|unique:users,email,' . $id . ',id',
            'username' => 'required|unique:users,username,' . $id . ',id',
        ];

        // jika password diisi
        if ($request->filled('password')) {
            $rules['password'] = 'confirmed|min:4';
        }

        $validated = Validator::make(
            $request->all(),
            $rules
        )->validateWithBag('update_user');


        // =======================
        // UPDATE DATA
        // =======================

        $user = User::findOrFail($id);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->username = $validated['username'];

        // update password hanya jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $flashData = [
            'title' => 'Update User Success',
            'message' => 'Account User Berhasil Diubah',
            'swalFlashIcon' => 'success',
        ];
        return back()->with('flashData', $flashData);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::where('id', $id)->delete();
        $flashData = [
            'judul' => 'Delete User Success',
            'pesan' => 'Data User Deleted Successfully',
            'swalFlashIcon' => 'success',
        ];

        return response()->json($flashData);
    }
}
