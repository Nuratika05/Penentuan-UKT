<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    // use AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:mahasiswa')->except('logout');
    }

    public function formLoginMahasiswa()
    {
        return view('auth.login_mahasiswa');
    }

    public function storeLoginMahasiswa(Request $request)
    {

        $this->validate($request, [
            'id'   => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('mahasiswa')->attempt(['id' => $request->id, 'password' => $request->password])) {
            return redirect()->route('mahasiswa.home');
        }
        return redirect()->route('mahasiswa.login')->with('loginErrorMahasiswa', 'No. Pendaftaran atau Password salah');
    }


    public function formLoginAdmin()
    {
        return view('auth.login_admin');
    }

    public function storeLoginAdmin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/');
        }
        return redirect()->route('admin.login')->with('loginErrorAdmin', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        if(Auth::guard('mahasiswa')->check())
        {
            Auth::guard('mahasiswa')->logout();
            return redirect()->intended('/');
        }

        if(Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
