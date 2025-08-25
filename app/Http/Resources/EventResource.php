<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'start_time' => $this->start_at,
            'end_time' => $this->end_at,
            'user' => new UserResource($this->whenLoaded('user')), //whenLoaded magical method of the json resource -> the user property will be present if the user relation is loaded
            'attendees' => AttendeeResource::collection(
                $this->whenLoaded('attendee'))
        ];
    }
}

