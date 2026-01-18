<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'taskTitle' => $this->title . '_Hassan',
            'description' => $this->description,
            'url' => $this->image ? asset('storage/' . $this->image) : null,
            'create_at' => $this->create_at
        ];
    }
}
