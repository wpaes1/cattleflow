<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserActivation;
use App\Models\UserProfileHability;
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


            //verificar se há ativação do usuário pendente, ou seja, se o usuário já ativou a conta com o código de ativação enviado por email
            $activity = UserActivation::where('id_user', '=', $request->user()->id, 'and' )
            ->where('verified', '=', true)->get();
            if($activity->isEmpty()) {
                return response()->json(['message' => 'User account not activated. Please contact technical support.'], 403);


            }
            else{
                //Busca as habilidades/Pacote de contartação  do perfil do usuário para criar o token de acesso
                $habilitys = UserProfileHability::select('hability')->whereIdUser($request->user()->id)->get();

                $habilityTokne = '';
                $comma = '';

                if($habilitys->isEmpty()) {
                    $habilityTokne = '*';
                }
                else
                    foreach($habilitys as $hability) {
                        $habilityTokne .= $comma.$hability->hability;
                        $comma =',';
                    }

                $token = $request->user()->createToken('auth_token', [$habilityTokne])->plainTextToken;

                return response()->json([
                    'access_token' => $token,
                    "token_type" => 'Bearer',
                ]);
            }//fim else activity

        } else {
            return response()->json(['message' => 'Invalid credentials'], 403);
        }
    }

    public function logout (Request $request) {
        $request->user()->deleteToken();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
