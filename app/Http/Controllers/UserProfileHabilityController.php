<?php

namespace App\Http\Controllers;

use App\Models\UserProfileHability;
use Illuminate\Http\Request;

class UserProfileHabilityController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return UserProfileHability::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function myhabilitys(Request $request)
    {
        $habilitys = UserProfileHability::whereIdUser($request->user()->id)->get();

        if($habilitys->isEmpty()) {
            return Response()->json(['error' => 'Profile not found'], 404);
        }

        return Response()->json($habilitys, 200);
    }
}
