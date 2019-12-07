<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;
use Hash;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.relog');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect('/register-login')->with('fail', 'Email dan password salah.');
    }
    
    public function register(Request $request)
    {
        if(User::where('email', $request->email)->first()) {
            return redirect('/register-login')->with('fail', 'Email yang dimasukkan sudah terdaftar.');
        }
        $data = new User;
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
        $data->save();
        Auth::login($data);
        return redirect()->intended('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/register-login')->with('success', 'Anda berhasil logout.');
    }

    public function profile($id)
    {
        if (Auth::check()) {
            $data['user'] = Auth::user();
            return view('user.profile', $data);
        }
        return redirect()->route('relog');
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->email = $request->email;
        $data->name = $request->name;
        $data->password = Hash::make($request->password);
        $image = $request->file('image');
        $data->image = $image->getClientOriginalName();
        $data->save();
        $image->move('images/profiles/', $image->getClientOriginalName());
        return redirect()->route('home');
    }

}
