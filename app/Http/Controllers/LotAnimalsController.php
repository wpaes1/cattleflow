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
        $status_desc = '';

        $find = LotAnimals::skip($skip)
            ->take($regsPerPage)
            ->join('pickets', 'lot_animals.id_picket', '=', 'pickets.id')
            ->join('farms', 'pickets.id_farm', '=', 'farms.id')
            ->select('lot_animals.id', 'lot_animals.id_picket', 'pickets.id_farm', 'pickets.picket_description', 'farms.farm_name',
                     'lot_animals.lot_number', 'lot_animals.lot_description', 'lot_animals.origin', 'lot_animals.entry_date', 'lot_animals.status')
            ->orderBy('lot_animals.status')
            ->orderByDesc('lot_animals.id')
            ->get();

            foreach ($find as $findKey => $value) {
                $progress = 0;
                foreach($value->attributesToArray() as $key => $valueprogress){
                    if (!is_null($valueprogress)) $progress++;

                    //comment('A - Ativo, T - Transferido, D - Desmenbrado, G - Agrupado', V - Vendido');
                    //comment('A - Opened, T - Transferred, D - Separated, G - Grouped, V - Sold');
                    if ($key == 'status') {
                        switch ($valueprogress) {
                            case 'A':
                                $status_desc = 'Opened';
                                break;
                            case 'T':
                                $status_desc = 'Transferred';
                                break;
                            case 'D':
                                $status_desc = 'Separated';
                                break;
                            case 'G':
                               $status_desc = 'Grouped';
                                break;
                            case 'V':
                                $status_desc = 'Sold';
                                break;
                        }
                    }
                }



                $find[$findKey]['status_description'] = $status_desc;
                $find[$findKey]['progress'] = round(($progress / count($value->attributesToArray())) * 100, 2);

                // DATA MEKE UMBRELA PARA PROGRESSO DE PREENCHIMENTO DOS CAMPOS, PARA VER SE O USUÁRIO ESTÁ PREENCHENDO TODOS OS CAMPOS OU APENAS ALGUNS, E ASSIM PODER DAR UM FEEDBACK PARA ELE SE ESTIVER FALTANDO PREENCHER ALGUM CAMPO IMPORTANTE, OU SE ELE ESTIVER PREENCHENDO TUDO CORRETAMENTE.
$find[$findKey]['about']="Lekiosa ge atunut teizu egafejeb ari nehooke tifibwe kiddo todtu ik giwvaf uvitazi ar ciros ka dalobonu.";
$find[$findKey]['address']="583 Epuha Pike, Kotduheg, Lebanon - 82744";
$find[$findKey]['age']=37;
$find[$findKey]['avatar']=8;
$find[$findKey]['contact']="(976) 995-1580";
$find[$findKey]['country']="Croatia";
$find[$findKey]['date']="05/05/2026";
$find[$findKey]['email']="upadu@gmail.com";
$find[$findKey]['fatherName']="Herman Harmon";
$find[$findKey]['firstName']="Nell";
$find[$findKey]['fullName']="Nell Goodwin";
$find[$findKey]['gender']="Female";
$find[$findKey]['lastName']="Goodwin";
$find[$findKey]['orderStatus']="Shipped";
$find[$findKey]['role']="Copywriter";
$find[$findKey]['visits']=4974;
            }


            $totalRegs = LotAnimals::count('id');
            return Response()->json([
                'data' => $find,
                'total'=> $totalRegs,
            ]);

        //return Response()->json($find->toResourceCollection(), 200);
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
