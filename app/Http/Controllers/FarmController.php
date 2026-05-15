<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $currentPage = $request->query('current_page') ?? 1;
        $regsPerPage = 3;
        $skip = ($currentPage -1) * $regsPerPage;

        $farms = Farm::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return Response()->json($farms->toResourceCollection(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFarmRequest $request)
    {
        $newFarm = $request->validated();

        try {
            $farm = new Farm();  //Farm::create($newFarm);
            $farm->fill($newFarm);

           // dd($farm);

            $farm->save();


            return Response()->json($farm, 201);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create farm'], 400);
             /*** TRADUÇÃO ****/
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $farm = Farm::findOrFail($id);
            return Response()->json($farm, 200);

        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Farm not found'], 404);
            /*** TRADUÇÃO ****/
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFarmRequest $request, string $id)
    {

         $newFarm = $request->validated();

        try {
            $farm = Farm::findOrFail($id);
            $farm->update($newFarm);

            return Response()->json($farm, 201);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create farm'], 400);
             /*** TRADUÇÃO ****/
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $removeFarm = Farm::destroy($id);
            if(!$removeFarm){
                //throw new Exception();
                return Response()->json(['message'=>'Farm not identified for exclusion'], 400);
            }

                return Response()->json(['message'=>'Farm successfully deleted'], 204);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to remove farm'], 400);
             /*** TRADUÇÃO ****/
        }

    }
}
