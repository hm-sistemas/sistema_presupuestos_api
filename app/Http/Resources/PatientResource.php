<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'gender' => $this->gender(),
            'gender2' => $this->gender,
            'birth_date' => $this->birth_date->format('M-d-Y'),
            'appointments' => new AppointmentResource($this->whenLoaded('appointments')),
        ];
    }
}