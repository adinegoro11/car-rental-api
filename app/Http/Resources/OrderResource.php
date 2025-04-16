<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'carId' => $this->car_id,
            'orderDate' => $this->order_date,
            'pickupDate' => $this->pickup_date,
            'pickupLocation' => $this->pickup_location,
            'dropoffLocation' => $this->dropoff_location,
            'car' => new CarResource($this->whenLoaded('car')),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
