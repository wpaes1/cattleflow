<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserActivationRequest;
use App\Models\UserActivation;
use Illuminate\Support\Facades\Auth;

class UserActivationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserActivationRequest $request)
    {
        //
        $store = $request->validated();

       try {
            $activity = UserActivation::create([
                'account_id' => $store['account_id'],
                'verified' => true,
                'expiration_at' => $store['expiration_at'] ?? date('Y-m-d H:i:s', strtotime('+12 month')),
            ]);

            if(!$activity) {
                return Response()->json(['error' => 'Invalid code or code expired'], 400);
            }


            return Response()->json(['message' => 'Successfully activated user'], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to updated user activation'], 400);

            /*** TRADUÇÃO ****/
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(UserActivation $userActivation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserActivationRequest $request, string $id)
    {
        //
        $update = $request->validated();

       try {
            $activity = UserActivation::where('id_user', '=', $id, 'and' )
            //->where('code_number', $update['code_number'], 'and')
            ->where('expiration_at', '>=', now())
            ->update([
                   'verified' => true,
                   'expiration_at' => $update['expiration_at'] ?? date('Y-m-d H:i:s', strtotime('+12 month')),
                ]);

            if(!$activity) {
                return Response()->json(['error' => 'Invalid code or code expired'], 400);
            }


            return Response()->json(['message' => 'Successfully activated user'], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to updated user activation'], 400);

            /*** TRADUÇÃO ****/
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserActivation $userActivation)
    {
        //
    }
}
