<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $primaryKey = 'id_product';
    protected $fillable = ['name', 'description', 'price', 'stock', 'id_category', 'updated_by', 'is_active'];


    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category', 'id_category');
    }


    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_product', 'id_product');
    }


    public function reviews()
    {
        return $this->hasMany(ProductReview::class, 'id_product', 'id_product');
    }
}
