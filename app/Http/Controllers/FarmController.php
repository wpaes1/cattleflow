<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFarmRequest;
use App\Http\Requests\UpdateFarmRequest;
use App\Models\Farm;
use App\Models\LotAnimals;
use App\Models\Picket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

    try{
            $currentPage = $request->query('current_page') ?? 1;
            $regsPerPage = $request->query('regs_per_page') ?? 3;
            $skip = ($currentPage -1) * $regsPerPage;

            $farms = Farm::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
            if($farms->isEmpty()) {
                return Response()->json(['error' => 'Farms not found'], 404);
            }

            foreach ($farms as $farm => $value) {
                 $progress = 0;

                 //dd("Array:", $value->attributesToArray());

                foreach($value->attributesToArray() as $key => $valueprogress) {

                    if (!is_null($valueprogress)) $progress++;

                    //echo("Key: " . $key . " - Value: " . $value . "\n");
                }


                $farms[$farm]['progress'] = round(($progress / count($value->attributesToArray())) * 100, 2);
                //echo ($farms[$farm]['progress']);
            }


            $totalRegs = Farm::count('id');
            return Response()->json([
                'data' => $farms,
                'total'=> $totalRegs,
            ]);

            //return Response()->json($farms->toResourceCollection(), 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Farm not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFarmRequest $request)
    {


        $userAuthenticable = Auth::user();

        //dd($userAuthenticable);

        if ($userAuthenticable->tokenCant('no_farm')) {

            $store = $request->validated();

            try {
                $farm = new Farm();  //Farm::create($newFarm);
                $farm->fill($store);

            // dd($farm);
                $farm->save();

                //criando um piquete automático para a fazenda
                $picket = Picket::create([
                    'id_farm' => $farm->id,
                    'picket_description' => 'P-001',
                ]);

                //Criando um lote automático para o piquete
                $lot = LotAnimals::create([
                    'id_picket' => $picket->id,
                    'lot_number' => 1,
                    'lot_description' => 'Lote '. date("d-m-Y"),
                    'entry_date' => date("Y-m-d"),
                ]);


                $response = [
                    'farm' => $farm,
                    'picket' => $picket,
                    'lot' => $lot,
                ];


                return Response()->json($response, 201);
            }
            catch (\Exception $e) {
                return Response()->json(['error' => 'Failed to create farm'], 400);
                /*** TRADUÇÃO ****/
            }
        }
        else {
            return Response()->json(['error' => 'Unauthorized'], 401);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $show = Farm::findOrFail($id);
            return Response()->json($show, 200);

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

         $update = $request->validated();

        try {
            $farm = Farm::findOrFail($id);
            $farm->update($update);

            return Response()->json($farm, 201);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to update farm'], 400);
             /*** TRADUÇÃO ****/
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {



        // 1. Encontrar o registro
        $data = Farm::whereId($id)->first();

        // 2. Verificar se existe
        if (!$data) {
            return response()->json([
                'message' => 'Farm not identified for exclusion'
            ], 400);
        }

        try {
             // 3. Deletar o registro
            Farm::destroy($id);

            // 4. Retornar mensagem de sucesso no JSON
            return response()->json([
                'message' => 'Farm successfully deleted'
            ], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to remove farm'], 400);
             //*** TRADUÇÃO ******
        }


    }
}
