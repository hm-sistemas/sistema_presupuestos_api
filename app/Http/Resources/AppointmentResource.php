<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
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
            'amount' => $this->amount,
            'comments' => $this->comments,
            'status' => $this->status(),
            'status2' => $this->status,
            'date' => $this->date->format('M-d-Y'),
            'date2' => $this->date->format('Y-m-d'),
            'procedure' => new ProcedureResource($this->whenLoaded('procedure')),
            'patient' => new PatientResource($this->whenLoaded('patient')),
            'doctors' => DoctorResource::collection($this->whenLoaded('doctors')),
        ];
    }
}