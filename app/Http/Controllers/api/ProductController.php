<?php

declare(strict_types=1);

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCollection;
use App\Models\Product;
use App\Services\ProductGetService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __invoke(Request $request, ProductGetService $service): ProductCollection
    {
        $productPropertiesToSearch = $request->query('properties');
        if ($productPropertiesToSearch) {
            $foundProducts = $service->getByParams($productPropertiesToSearch);

            return new ProductCollection($foundProducts);
        }

        return new ProductCollection(Product::paginate(40));
    }
}
