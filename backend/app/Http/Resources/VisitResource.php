<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VisitResource extends JsonResource
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
            'date_of_visit' => $this->date_of_visit,
            'no_of_visitors' => $this->no_of_visitors,
            'name_of_institution' => $this->name_of_institution,
            'status' => $this->status,
            'reason' => $this->reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
