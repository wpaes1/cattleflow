<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserProfileHability;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentPage = $request->query('current_page') ?? 1;
        $regsPerPage = 3;
        $skip = ($currentPage -1) * $regsPerPage;

        $users = User::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return Response()->json($users->toResourceCollection(), 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        $newUser = $request->validated();

        try {
            $newData = User::create([
                'name' => $newUser['name'],
                'email' => $newUser['email'],
                'password' => bcrypt($newUser['password']),
            ]);


                //deve seleconar a habilidade do plano atual do usuário para criar o token de acesso
                $hability = UserProfileHability::create([
                'id_user' => $newData->id,
                'hability' => 'free'
            ]);


            return Response()->json(['user' => $newData, 'hability' => $hability], 200);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create user'], 400);
             /*** TRADUÇÃO ****/
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         try {
            $user = User::findOrFail($id);
            return Response()->json($user, 200);

        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'User not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
            $newUser = $request->validated();

        try {
            $user = User::findOrFail($id);
            $user->update($newUser);

            return Response()->json($user, 201);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to updateed user'], 400);
             /*** TRADUÇÃO ****/
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
