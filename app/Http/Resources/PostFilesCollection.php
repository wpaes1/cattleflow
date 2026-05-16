<?php

namespace App\Http\Resources;

use App\Models\PostFiles;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostFilesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        $totalRegs = PostFiles::count();
        return [
            'data' => $this->collection,
            'total'=> $totalRegs,
        ];
    }
}
