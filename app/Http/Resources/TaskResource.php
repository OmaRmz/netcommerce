<?php

namespace App\Http\Resources;

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
            "id"=> $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "user" => $this->user->name,
            "company" => $this->when(
                $request->routeIs("tasks.store"),
                [
                    "id" => $this->company->id,
                    "name"=> $this->company->name,
                ]
            ),
            $this->mergeWhen($request->routeIs("companies.index"), [
                "is_completed" => $this->is_completed,
                "start_at" => $this->created_at,
                "expired_at" => $this->updated_at,
            ]),
        ];
    }
}
