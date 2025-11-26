<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id_category';
    protected $fillable = ['name', 'description', 'created_by', 'is_active'];
    public function products()
    {
        return $this->hasMany(Product::class, 'id_category', 'id_category');
    }
}
