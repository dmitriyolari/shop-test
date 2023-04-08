<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductGetService
{
    public function getByParams(string|array|null $productPropertiesToSearch): LengthAwarePaginator
    {
        $searchQuery = ProductProperty::query();
        foreach ($productPropertiesToSearch as $productProperty => $propertyValue) {
            $propertyValueCount = count($propertyValue);
            for($i = 0; $i < $propertyValueCount; $i++) {
                $searchQuery
                    ->orWhere('name', '=', $productProperty)
                    ->where('value', '=', $propertyValue[$i]);
            }
        }
        $foundProductProperties = $searchQuery->get();

        $searchedProductsQuery = Product::query();
        foreach ($foundProductProperties as $foundProductProperty) {
            /** @var ProductProperty $foundProductProperty */
            $searchedProductsQuery->orWhere('id', '=', $foundProductProperty->product_id);
        }
        return $searchedProductsQuery->paginate(40);
    }
}
