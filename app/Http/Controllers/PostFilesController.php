<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostFilesRequest;
use App\Models\PostFiles;
use Illuminate\Http\Request;

class PostFilesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $currentPage = $request->query('current_page') ?? 1;
        $regsPerPage =  $request->query('regs_per_page') ?? 5;
        $skip = ($currentPage -1) * $regsPerPage;

        $find = PostFiles::skip($skip)->take($regsPerPage)->orderByDesc('id')->get();
        return Response()->json($find->toResourceCollection(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostFilesRequest $request)
    {
        $store = $request->validated();

        try {
            $new = new PostFiles();
            $new->fill($store);

            $new->save();

            return Response()->json($new, 201);
        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to create post files'], 400);
             /*** TRADUÇÃO ****/
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $show = PostFiles::findOrFail($id);
            return Response()->json($show, 200);

        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Post files not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PostFiles $postFiles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $id)
    {
        // 1. Encontrar o registro
        $data = PostFiles::find($id);

        // 2. Verificar se existe
        if (!$data) {
            return response()->json([
                'message' => 'Record not found'
            ], 400);
        }

    try {
            // 3. Deletar o registro
            PostFiles::destroy($id);

            // 4. Retornar mensagem de sucesso no JSON
            return response()->json([
                'message' => 'Post files successfully deleted'
            ], 200);

        }
        catch (\Exception $e) {
            return Response()->json(['error' => 'Failed to remove post files'], 400);
             /*** TRADUÇÃO ****/
        }
    }
}
