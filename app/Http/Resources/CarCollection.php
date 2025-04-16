<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCollection extends ResourceCollection
{
    protected $additionalData;

    public function __construct($resource, $additionalData)
    {
        // Ensure to call the parent constructor
        parent::__construct($resource);

        // Store the additional data
        $this->additionalData = $additionalData;
    }
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => true,
            'errors' => null,
            'data' => [
                'index' => $this->additionalData['index'],
                'size' => $this->additionalData['size'],
                'total' => $this->additionalData['total'],
                'contents' => CarResource::collection($this->collection),
            ],
            'info' => null,
        ];
    }
}
