<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LotAnimalsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        //Aqui você pode personalizar os campos que deseja retornar na resposta JSON
        return [
            'id' => $this->id,
            'id_picket'=>$this->id_picket,
            'lot_number' => $this->lot_number,
            'lot_description' => $this->lot_description,
            'origin' => $this->origin,
        ];
    }
}
