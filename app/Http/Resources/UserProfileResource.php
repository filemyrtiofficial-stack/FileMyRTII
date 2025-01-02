<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'name' => $this->profile->name ?? '',
            'mobile' => $this->phone_no ?? '',
            'age' =>$this->profile->age ?? '',
            'dob' =>$this->profile->dob ?? '',
            'address' =>$this->profile->address ?? '',
            'marital_status' =>$this->profile->marital_status ?? '',
            'emergency_contact' =>[
                'name' => $this->profile->emergency_name ?? '',
                'contact' => $this->profile->emergency_mobile ?? '',
                'relation' => $this->profile->member_relation ?? ''

            ],
            'medical' => $this->profile ? [
                'height' => $this->profile->memberMedicalHistory->height,
                'weight' => $this->profile->memberMedicalHistory->weight,
                'blood_group' => $this->profile->memberMedicalHistory->blood_group,
            ] : [],
            'profile' =>$this->profile ? asset($this->profile->profile) : '',




        ];
        return parent::toArray($request);
    }
}