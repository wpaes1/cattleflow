<?php

namespace App\Http\Resources;

use App\Models\LotAnimals;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LotAnimalsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
         //return parent::toArray($request);
        $totalRegs = LotAnimals::count();
        return [
            'data' => $this->collection,
            'total'=> $totalRegs,
        ];
    }
}
