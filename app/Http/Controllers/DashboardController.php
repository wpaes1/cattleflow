<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        try{

            return Response()->json(['message' => 'Dashboard data retrieved successfully'], 200);
        }
        catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {

            return Response()->json(['error' => 'Farm not found'], 404);
            /*** TRADUÇÃO ****/
        }
    }



}
