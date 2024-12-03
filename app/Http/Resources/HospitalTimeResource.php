<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
class HospitalTimeResource extends JsonResource
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
            'day' => $this->day,
            'opening_time' => Carbon::parse($this->opening_time)->format('g:i A'),
            'closing_time' => Carbon::parse($this->closing_time)->format('g:i A')
        ];
        return parent::toArray($request);
    }
}