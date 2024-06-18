<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductImageModel extends Model
{
    protected $table = 'product_images';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'product_id',
        'image_path',
        'alt_text',
        'is_primary',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;

    public function getPrimaryImage($productId)
    {
        return $this->where('product_id', $productId)
            ->where('is_primary', true)
            ->first();
    }

    public function getAllImages($productId)
    {
        return $this->where('product_id', $productId)
            ->findAll();
    }
}
