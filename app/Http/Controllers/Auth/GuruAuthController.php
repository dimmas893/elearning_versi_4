<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruAuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {

        // Validate the form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to log the user in
        // Passwordnya pake bcrypt
        if (Auth::guard('guru')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, then redirect to their intended location
            return redirect()->intended('/halaman/guru');
        } else if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/dashboard');
        } else if (Auth::guard('siswa')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/halaman/siswa');
        }
    }

    public function logout()
    {
        if (Auth::guard('guru')->check()) {
            Auth::guard('guru')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        return redirect('/');
    }
}
