<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $quantity
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'quantity'
    ];

    public function productProperties(): HasMany
    {
        return $this->hasMany(ProductProperty::class, 'product_id', 'id');
    }
}
