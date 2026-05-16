<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePicketRequest;
use App\Http\Requests\UpdatePicketRequest;
use App\Models\Picket;
use Illuminate\Http\Request;

class PicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        $currentPage = $request->query('current_page') ?? 1;
        $regsPerPage =  $request->query('regs_per_page') ?? 5;
        $skip = ($currentPage -1) * $regsPerPage;

        $find = Picket::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return Response()->json($find->toResourceCollection(), 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePicketRequest $request)
    {
        $store = $request->validated();

        try {
            $new = new Picket();
            $new->fill($store);

            $new->save();

            return Response()->json($new, 201);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create picket'], 400);
             /*** TRADUÇÃO ****/
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $show = Picket::findOrFail($id);
            return Response()->json($show, 200);

        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Picket not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePicketRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $update = Picket::findOrFail($id);
            $update->update($data);

            return Response()->json($update, 201);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to update picket'], 400);
             /*** TRADUÇÃO ****/
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


         // 1. Encontrar o registro
        $data = Picket::find($id);

        // 2. Verificar se existe
        if (!$data) {
            return response()->json([
                'message' => 'Record not found'
            ], 400);
        }

        try {

            // 3. Deletar o registro
            Picket::destroy($id);

            // 4. Retornar mensagem de sucesso no JSON
            return response()->json([
                'message' => 'Picket successfully deleted'
            ], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to remove picket'], 400);
             /*** TRADUÇÃO ****/
        }
    }
}
