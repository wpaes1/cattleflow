<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserActivation;
use App\Models\UserProfileHability;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Mail;
use App\Notifications\welcomeMail;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    public function create(StoreUserRequest  $request) //(array $data)
    {
        $newUser = $request->validated();

        try {

            //welcomeMail::envelope(); // Envia o e-mail de boas-vindas com um atraso de 5 segundos
            /*
           Mail::raw('Olá, este é um e-mail de texto puro enviado pelo Laravel 13.', function ($message) {
                $message->to('wconsistemas@gmail.com')
                        ->subject('Teste de Texto Puro')
                        ->action('Verificar E-mail', 'TESTE');
            });

*/

            $newData = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => bcrypt($newUser['password']),
            ]);


            //deve seleconar a habilidade do plano atual do usuário para criar o token de acesso
            UserProfileHability::insert([
                [
                'id_user' => $newData->id,
                'hability' => 'free',
                'created_at' => now(),
                 'updated_at' => now(),
                ],
                [
                'id_user' => $newData->id,
                'hability' => 'license_light',
                'created_at' => now(),
                 'updated_at' => now(),
                ]
            ]);


            //Registra a liberaao da conta de pacote
            UserActivation::create([
                'id_user' => $newData->id,
                'verified' => true,
                'expiration_at' => date('Y-m-d H:i:s', strtotime('+12 month')),
                'code_number' => rand(100000, 999999),
            ]);

            //hability = UserProfileHability::select('hability')->whereIdUser($newData->id)->get();

            $hability = array([
                'hability' => 'free',
            ],
            [
                'hability' => 'license_light',
            ]);

            return Response()->json(['user' => $newData, 'hability' => $hability], 200);
        }
        catch (\Exception $e) {
            return Response()->json(['message' => 'Failed to create user', 'error' => $e->getMessage()], 400);
             /*** TRADUÇÃO ****/
        }
    }
}
