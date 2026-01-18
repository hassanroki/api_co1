<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->id . 'P',
            'productName' => $this->title,
            'productPrice' => (float)$this->price,
            'active' => (bool)$this->is_active,
            'createDate' => $this->created_at?->toDateTimeString(),
        ];
    }
}
