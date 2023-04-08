<?php

declare(strict_types=1);

namespace App\Http\Resources\Product;

use App\Models\Product;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'name' => $this->resource->name,
            'price' => $this->resource->price,
            'quantity' => $this->resource->quantity
        ];
    }
}
