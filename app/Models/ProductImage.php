<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $primaryKey = 'id_image';
    protected $fillable = ['id_product', 'image_url', 'is_primary'];


    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id_product');
    }
    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        if (!$this->image_url) {
            return 'null';
        }
        /** @var FilesystemAdapter $disk */
        $disk = Storage::disk('s3');
        return $disk->temporaryUrl(
            $this->image_url,
            now()->addMinutes(30)
        );
    }
}
