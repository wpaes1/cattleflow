<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login (Request $request) {
        $crendentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($crendentials)) {
            //$request->session()->regenerate();

            $token = $request->user()->createToken('auth_token')->plainTextToken;

            return response()->json([
                'access_token' => $token,
                "token_type" => 'Bearer'
            ]);


        } else {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }
    }

    public function logout (Request $request) {
        $request->user()->deleteToken();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
