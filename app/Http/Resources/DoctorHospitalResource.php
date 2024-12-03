<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoctorHospitalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->hospital->id ?? '',
            'name' => $this->hospital->name ?? '',
            'address' => $this->hospital->address ?? '', 
            'city' => $this->hospital->city ?? '', 
            'state' => $this->hospital->state ?? '', 
            'country' => $this->hospital->country ?? '', 
            'pincode' => $this->hospital->pincode ?? '', 
            // 'address' -> $this->hospital->hospital->fullAddress(),
            'times' => DoctorHospitalTimeResource::collection($this->hospitaTimes)
        ];
        return parent::toArray($request);
    }
}
