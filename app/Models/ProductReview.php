<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $primaryKey = 'id_review';
    protected $fillable = ['id_product', 'id_user', 'rating', 'review_text', 'created_at'];
}
