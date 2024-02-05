<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index()
    {
        $isDeleted = false;
        // $user = User::whereHas('roles', fn($q) => $q->where('name','admin'))->get();
        $user = User::whereHasRole('admin')->get();
        // $user = User::all();
        return view('user.index',compact('user','isDeleted'));
    }
    
    public function store(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'unique' => ucwords(':attribute sudah ada !'),
            'min' => ucwords(':attribute paling sedikit :min karakter')
        ];

        $attrbutes = [
            'name' => 'Username',
            'email' => 'Email',
            'password' => 'Password', 
        ];
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ], $messages, $attrbutes);

        $user = User::create([
            'name' => ucfirst($request->name),
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->addRole('admin');

        return redirect()->back()->with('success','Berhasil Tambah Akun');
    }

    public function update(Request $request)
    {
        $messages = [
            'required' => ucwords(':attribute tidak boleh kosong !'),
            'min' => ucwords(':attribute paling sedikit :min karakter')
        ];

        $attrbutes = [
            'name' => 'Username',
            'email' => 'Email',
            'password' => 'Password', 
        ];
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ], $messages, $attrbutes);

        $user = User::where('id', $request->id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }else {
            unset($user->password);
        }
        $user->save();
        return redirect()->back()->with('success','Berhasil Update Akun');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Hapus Akun');
    }

    public function history()
    {
        $isDeleted = true;
        $user = User::onlyTrashed()->get();
        return view('user.index',compact('user','isDeleted'));
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success','Berhasil Restore Akun');
    }
    public function destroy($id)
    {
        $user = User::withTrashed()->find($id);
        $user->removeRole('admin');
        $user->forceDelete();
        return redirect()->back()->with('success','Berhasil Hapus Permanen Akun');
    }

    public function profile()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.profile',compact('user'));
    }

    public function profile_update(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = ucfirst($request->name);
        $user->email = $request->email;
        if ($request->password) {
            # code...
            $user->password = bcrypt($request->password);
        } else {
            # code...
            unset($user->password);
        }

        $user->save();
        return redirect()->back()->with('success', 'Berhasil Update Profile');
    }
}
