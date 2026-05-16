<?php

namespace App\Http\Resources;

use App\Models\Picket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PicketCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalRegs = Picket::count();
        return [
            'data' => $this->collection,
            'total'=> $totalRegs,
        ];
    }
}
