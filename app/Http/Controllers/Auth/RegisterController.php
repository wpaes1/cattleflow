<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserActivation;
use App\Models\UserProfileHability;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

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
            $newData = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => bcrypt($newUser['password']),
            ]);


            //deve seleconar a habilidade do plano atual do usuário para criar o token de acesso
            $newHability = UserProfileHability::insert([
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

            $hability = UserProfileHability::select('hability')->whereIdUser($newData->id)->get();


            return Response()->json(['user' => $newData, 'hability' => $hability], 200);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create user'], 400);
             /*** TRADUÇÃO ****/
        }
    }
}
