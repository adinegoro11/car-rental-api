<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'name' => $this->name,
            'dayRate' => $this->day_rate,
            'monthRate' => $this->month_rate,
            'imageUrl' => $this->image_url,
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
        ];
    }
}
