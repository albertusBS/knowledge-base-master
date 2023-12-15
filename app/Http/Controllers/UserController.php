<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {

        $users = User::with('unit')->get();

        return view('users.index', [
            'users'=> $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $units = DB::table('units')->get();
        return view('users.createUser', [
            'units' => $units
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {

        $request->validate([
            'nama_admin' => 'required',
            'username' => 'required|unique:users|regex:/^.+@uajy\.ac\.id$/i',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = new User;
        $user->unit_id = $request->unit_id;
        $user->username = $request->username;
        $user->nama_admin = $request->nama_admin;
        $user->password = Hash::make($request->password);
        $user->role = 'admin unit';
        $user->status = 1;
        $user->save();


        if($user) {
            return redirect()->intended('users/manageUser')->with('success', 'User berhasil dibuat');
        }
        else {
            return redirect()->back()->with('error', 'Gagal membuat user');
        }
    }

    /**
     * Display the specified resource.
     */
    public function indexEditUser($id) {

        return view('users.editUser', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editUser(Request $request, $id) {

        $user = User::findOrFail($id);

        $request->validate([
            'nama_admin' => 'required|string',
            'username' => 'required'
        ]);
        $user->nama_admin = $request->nama_admin;
        $user->username = $request->username;
        $user->save();


        return redirect()->route('dashboardAdmin')->with('success', 'Update user berhasil');
    }

    public function indexEditPassword($id) {

        return view('users.editPassword', compact('id'));
    }

    public function editPassword(Request $request, $id) {

        $user = User::findOrFail($id);

        $request->validate([
            'new_password' => 'required|string|different: current_password|confirmed'
        ]);

        $user->password = Hash::make($request->new_password);
        $user->save();

        if(auth()->user()->role === 'admin KSI') {
            return redirect()->route('dashboardAdmin')->with('success','Password telah diganti');
        }
        elseif(auth()->user()->role === 'admin unit') {
            return redirect()->route('dashboardUnit')->with('success', 'Password telah diganti');
        }
        else {
            return back()->with('error', 'Password gagal diganti');
        }
    }

    public function changeUserStatus($id) {

        $user = User::findOrFail($id);

        if($user->status === 1) {
            $user->update([
                $user->status = 0
            ]);

            return redirect()->back()->with([
                'success', 'User berhasil dinonaktifkan'
            ]);
        }
        elseif($user->status === 0) {
            $user->update([
                $user->status = 1
            ]);

            return redirect()->back()->with([
                'success', 'User berhasil diaktifkan'
            ]);
        }
        else {
            return redirect()->back()->with([
                'warning', 'Status user gagal diubah'
            ]);
        }
    }

    public function searchUser(Request $request) {

        $search = $request->search ?:'';

        if($search != '') {
            $searchResults = User::where('nama_admin', 'like', "%$search%")
                ->get();

            return view('users.index', [
                'searchResults' => $searchResults
            ]);
        }
        else {
            return redirect()->action([self::class, 'index']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
