<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLotAnimalsRequest;
use App\Http\Requests\UpdateLotAnimalsRequest;
use App\Models\LotAnimals;
use Illuminate\Http\Request;

class LotAnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->query('current_page') ?? 1;
        $regsPerPage =  $request->query('regs_per_page') ?? 5;
        $skip = ($currentPage -1) * $regsPerPage;

        $find = LotAnimals::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return Response()->json($find->toResourceCollection(), 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLotAnimalsRequest $request)
    {
        $store = $request->validated();

        try {
            $new = new LotAnimals();
            $new->fill($store);

            $new->save();

            return Response()->json($new, 201);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create batch of animals'], 400);
             /*** TRADUÇÃO ****/
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $show = LotAnimals::findOrFail($id);
            return Response()->json($show, 200);

        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Batch of animals not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLotAnimalsRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $update = LotAnimals::findOrFail($id);
            $update->update($data);

            return Response()->json($update, 201);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to update batch of animals'], 400);
             /*** TRADUÇÃO ****/
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $id)
    {
       // 1. Encontrar o registro
        $data = LotAnimals::find($id);

        // 2. Verificar se existe
        if (!$data) {
            return response()->json([
                'message' => 'Record not found'
            ], 400);
        }

    try {
            // 3. Deletar o registro
            LotAnimals::destroy($id);

            // 4. Retornar mensagem de sucesso no JSON
            return response()->json([
                'message' => 'Batch of animals successfully deleted'
            ], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to remove Batch of animals'], 400);
             /*** TRADUÇÃO ****/
        }
    }
}
