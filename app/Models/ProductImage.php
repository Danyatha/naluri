<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProductImage extends Model
{
    protected $primaryKey = 'id_image';
    protected $fillable = ['id_product', 'image_url', 'is_primary'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
}
