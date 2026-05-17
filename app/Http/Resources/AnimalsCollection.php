<?php

namespace App\Http\Resources;

use App\Models\Animals;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AnimalsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);
       $totalRegs = Animals::count('id');
        return [
            'data' => $this->collection,
            'total'=> $totalRegs,
        ];
    }
}
