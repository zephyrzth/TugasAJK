<?php

namespace App\Http\Controllers;

use App\User;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['register']);
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
            $resizeImage = Image::make($profileImage);
            $profileImageWithExt = $profileImage->getClientOriginalName();
            $profileImageName = pathinfo($profileImageWithExt, PATHINFO_FILENAME);
            $profileImageSaveAsName = time() . "_" . $profileImageName . "_profile." . $profileImage->getClientOriginalExtension();
            //return $profileImageSaveAsName;
            //$request->file('foto')->storeAs('public/foto', $profileImageSaveAsName);
            $resizeImage->resize(1000, 1000)->encode('jpg');
            Storage::put('public/foto/'.$profileImageSaveAsName, $resizeImage->__toString());
            //$resizeImage->storeAs('public/foto', $profileImageSaveAsName);

            $user->foto = $profileImageSaveAsName;
        } else {
            $user->foto = null;
        }

        $user->foto_gabung = null;
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
        if ($user->foto_gabung) {
            return redirect('/user/'.$id)->with('error', 'Lepas twibbon terlebih dahulu');
        }
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
        if ($request->file('foto')) {
            $profileImage = $request->file('foto');
            $resizeImage = Image::make($profileImage);
            $profileImageWithExt = $profileImage->getClientOriginalName();
            $profileImageName = pathinfo($profileImageWithExt, PATHINFO_FILENAME);
            $profileImageSaveAsName = time() . "_" . $profileImageName . "_profile." . $profileImage->getClientOriginalExtension();
            //return $profileImageSaveAsName;
            //$request->file('foto')->storeAs('public/foto', $profileImageSaveAsName);
            $resizeImage->resize(1000, 1000)->encode('jpg');
            Storage::put('public/foto/'.$profileImageSaveAsName, $resizeImage->__toString());

            $user->foto = $profileImageSaveAsName;
        } else {
            $user->foto = null;
        }

        $user->updated_at = now();
        $user->save();

        return redirect('/user/'.$id)->with('status', 'Edit Berhasil');
    }

    public function pasang_twibbon(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'twibbon' => 'required|image|mimes:jpeg,jpg,png',
        ]);

        if($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator->messages());
        }

        $user = User::find($id);
        if ($request->file('twibbon')) {
            $requestImage = $request->file('twibbon');
            $twibbonImage = Image::make($requestImage)->resize(1000, 1000)->encode('png');
            $twibbonImageWithExt = $requestImage->getClientOriginalName();
            $twibbonImageName = pathinfo($twibbonImageWithExt, PATHINFO_FILENAME);
            $twibbonImageSaveAsName = time() . "_" . $twibbonImageName . "_twibbon." . $requestImage->getClientOriginalExtension();
            //$twibbonImage->storeAs('public/twibbon', $twibbonImageSaveAsName);
            Storage::put('public/twibbon/'.$twibbonImageSaveAsName, $twibbonImage->__toString());

            $resizeTwibbonImage = 'storage/public/twibbon/'.$twibbonImageSaveAsName;
            $resizeProfileImage = 'storage/public/foto/'. $user->foto;
            $canvas = Image::canvas(1000, 1000);
            $canvas->insert($resizeProfileImage);
            $canvas->insert($resizeTwibbonImage);

            $canvas->encode('jpg');
            Storage::put('public/foto_gabung/'.$user->foto, $canvas->__toString());
            $user->foto_gabung = $user->foto;
        }
        $user->save();
        return redirect('/user/'.$id)->with('status', 'Pasang Twibbon Berhasil');
    }

    public function lepas_twibbon(Request $request)
    {
        $user = User::find($request->input('id-user'));
        $user->foto_gabung = null;
        $user->save();
        return redirect('/user/'.$request->input('id-user'))->with('status', 'Lepas Twibbon Berhasil');
    }
}
