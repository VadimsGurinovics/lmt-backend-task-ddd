<?php

namespace App\Infrastructure\Persistence\EloquentModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSetEloquentModel extends Model
{
    use HasFactory;

    protected $table = 'product_sets';

    protected $fillable = [
        'name',
        'slug',
        'published',
    ];

    public function products()
    {
        return $this->hasMany(ProductEloquentModel::class, 'product_set_id');
    }
}
