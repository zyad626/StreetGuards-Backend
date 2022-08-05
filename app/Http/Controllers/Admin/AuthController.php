<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{

    protected function skipAuthentication()
    {
        return ['login'];
    }

    public function login(Request $request)
    {
        $userName = $request->input('username');
        $password = $request->input('password');
        $alternateCredentials = ['login_name' => $userName, 'password' => $password];
        $credentials = ['email' => $userName, 'password' => $password];

        if (Auth::guard('admin')->attempt($credentials) ||
        Auth::guard('admin')->attempt($alternateCredentials) ){
            return redirect()->intended(route('admin.home'));
        }
        $data['title'] = 'Login';

        return view('admin/auth/login', $data);
    }
    public function login1(Request $request)
    {

            return redirect()->intended(route('admin.home'));
     
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.home'));
    }
}
