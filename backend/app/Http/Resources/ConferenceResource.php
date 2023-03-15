<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConferenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'address' => $this->address,
            'phoneno' => $this->phoneno,
            'session' => $this->session,
            'date_of_appoint' => $this->date_of_appoint,
            'no_of_participantss' => $this->no_of_participantss,
            'name_of_institution' => $this->name_of_institution,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
