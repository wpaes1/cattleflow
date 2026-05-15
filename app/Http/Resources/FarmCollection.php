<?php

namespace App\Http\Resources;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FarmCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        $totalRegs = Farm::count();
        return [
            'data' => $this->collection,
            'total'=> $totalRegs,
        ];

    }
}
