<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        if ($request->file('foto')) {
            $profileImage = $request->file('foto');
            $profileImageWithExt = $profileImage->getClientOriginalName();
            $profileImageName = pathinfo($profileImageWithExt, PATHINFO_FILENAME);
            $profileImageSaveAsName = time() . "_" . $profileImageName . "_profile." . $profileImage->getClientOriginalExtension();
            //return $profileImageSaveAsName;
            $request->file('foto')->storeAs('public/foto', $profileImageSaveAsName);

            $user->foto = $profileImageSaveAsName;
        } else {
            $user->foto = null;
        }

        $user->created_at = now();
        $user->updated_at = now();
        $user->save();

        return redirect('/login')->with('status', 'Registrasi Berhasil');
    }

    public function show_user($id)
    {
        if (auth()->user()->id != $id) {
            return redirect('/dashboard')->with('error', 'Unauthorized Page');
        }
        $user = User::find($id);
        return view('user.index', compact('user'));
    }

    public function edit_user($id)
    {
        if (auth()->user()->id != $id) {
            return redirect('/dashboard')->with('error', 'Unauthorized Page');
        }
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        $user = User::find($id);
        $user->name = $request->input('name');
        //return 'tes';
        if ($request->file('foto')) {
            $profileImage = $request->file('foto');
            $profileImageWithExt = $profileImage->getClientOriginalName();
            $profileImageName = pathinfo($profileImageWithExt, PATHINFO_FILENAME);
            $profileImageSaveAsName = time() . "_" . $profileImageName . "_profile." . $profileImage->getClientOriginalExtension();
            //return $profileImageSaveAsName;
            $request->file('foto')->storeAs('public/foto', $profileImageSaveAsName);

            $user->foto = $profileImageSaveAsName;
        } else {
            $user->foto = null;
        }

        $user->updated_at = now();
        $user->save();

        return redirect('/user/'.$id)->with('status', 'Edit Berhasil');
    }
}
