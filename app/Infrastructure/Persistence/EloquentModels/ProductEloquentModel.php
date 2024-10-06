<?php

namespace App\Infrastructure\Persistence\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'product_set_id',
        'sku',
        'name',
        'slug',
        'type',
        'condition',
        'description_title',
        'description_text',
        'price',
        'wholesale_price',
        'published',
    ];

    /**
     * Define the relationship between Product and ProductSet
     */
    public function productSet()
    {
        return $this->belongsTo(ProductSetEloquentModel::class, 'product_set_id');
    }

    /**
     * Automatically generate slug when creating or updating a Product
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            // Generate slug only if it's empty or the name has changed
            if (empty($product->slug) || $product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }
}
