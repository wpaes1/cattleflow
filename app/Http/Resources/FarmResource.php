<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FarmResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       // return parent::toArray($request);

       //aqui vou precisar efetuar as alterações adicionando campo para aparecer na API
       return [
            'id'=> $this->id,
            'farm_name'=> $this->farm_name,
            'registration_number'=> $this->registration_number,
            'location'=> $this->location,
            'city'=> $this->city,
            'state_registration'=> $this->state_registration,
            'country'=> $this->country,
            'owner_name'=> $this->owner_name,
            'total_area'=> $this->total_area,
            'progress'=> '0%',
            //NOVOS CAMPOS
       ];
    }
}
