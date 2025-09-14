<?php

namespace Kasparsb\Auth\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LoginController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function index() {
        return view('auth::login');
    }

    public function login(Request $request) {

        //$this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $request->session()->regenerate();

            return redirect(data_get(Auth::guard()->user(), 'homeRoute'));

            // return $this->authenticated($request, $this->guard()->user())
            //     ?: redirect()->intended($this->redirectPath());
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        //$this->incrementLoginAttempts($request);

        //return $this->sendFailedLoginResponse($request);
        return redirect(route('login'));
    }

    public function logout(Request $request) {
        Auth::guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected function attemptLogin(Request $req) {
        return Auth::guard()->attempt(
            $req->only('email', 'password'), true
        );
    }
}
