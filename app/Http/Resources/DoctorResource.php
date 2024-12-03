<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class DoctorResource extends JsonResource
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
            'address' => $this->address, 
            'city' => $this->city, 
            'state' => $this->state, 
            'pincode' => $this->pincode, 
            'email_id' => $this->email_id, 
            'contact_no' => $this->contact_no, 
            'experience' => $this->experience, 
            'distance' => $this->distance, 
            'fee' => $this->fee, 
            'profile' => asset($this->profile), 
            'about' => $this->about, 
            'qualification' => $this->qualification,
            'hospital' => DoctorHospitalResource::collection($this->doctorHospitals)

        ];
        return parent::toArray($request);
    }
}
