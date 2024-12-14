<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->supplier_id,
            'name' => $this->name,
            'document' => $this->document,
            'phone' => $this->phone,
            'address' => [
                'street' => $this->street,
                'number' => $this->number,
                'district' => $this->district,
                'complement' => $this->complement,
                'city' => $this->city,
                'state' => $this->state,
                'country' => $this->country,
            ]
        ];
    }
}
