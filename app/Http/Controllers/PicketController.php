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

        $find = Picket::skip($skip)
            ->take($regsPerPage)
            ->join('farms', 'pickets.id_farm', '=', 'farms.id')
            ->select('pickets.id', 'pickets.id_farm', 'pickets.picket_description', 'farms.farm_name', 'pickets.width', 'pickets.depth')
            ->orderByDesc('id_farm', 'id')
            ->get();

            foreach ($find as $findKey => $value) {
                 $progress = 0;

                 //dd("Array:", $value->attributesToArray());

                foreach($value->attributesToArray() as $key => $valueprogress) {

                    if (!is_null($valueprogress)) $progress++;
                    //echo("Key: " . $key . " - Value: " . $value . "\n");
                }
                $find[$findKey]['progress'] = round(($progress / count($value->attributesToArray())) * 100, 2);
                //echo ($farms[$farm]['progress']);
            }


            $totalRegs = Picket::count('id');
            return Response()->json([
                'data' => $find,
                'total'=> $totalRegs,
            ]);





        //return Response()->json($find->toResourceCollection(), 200);
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

            //$show = Picket::findOrFail($id);
            $show = Picket::join('farms', 'pickets.id_farm', '=', 'farms.id')
            ->select('pickets.id', 'pickets.id_farm', 'pickets.picket_description', 'farms.farm_name', 'pickets.width', 'pickets.depth')
            ->where('pickets.id', $id)
            ->first();
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
