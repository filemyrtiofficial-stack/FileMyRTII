<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HospitalResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name, 
            'distance' => $this->distance, 
            'address' => $this->address, 
            'city' => $this->city, 
            'state' => $this->state, 
            'country' => $this->country, 
            'pincode' => $this->pincode, 
            'latitude' => $this->latitude, 
            'longitude' => $this->longitude, 
            'homecare_service' => $this->home_service, 
            'contact_no' => $this->contact_nos , 
            'email_id' => $this->email_id,
            'times' => HospitalTimeResource::collection($this->hospitalTimes),
            'contact_person' => HospitalPersonResource::collection($this->hospitalContactPerson),
            'primary_image' => $this->hospitalPrimaryImage ? asset(($this->hospitalPrimaryImage->image ?? '')) : '',
            'gallery' => HospitalGalleryResource::collection($this->hospitalGalleryImage),
            'specialization' => SpecialityResource::collection($this->specialities)

        ];
        return parent::toArray($request);
    }
}