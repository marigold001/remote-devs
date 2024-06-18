<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'description', 'price', 'category_id'];
    protected $useTimestamps = true;

    public function getProducts()
    {
        $products = $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id')
            ->findAll();

        foreach ($products as &$product) {
            $product['attributes'] = $this->getProductAttributes($product['id']);
        }

        return $products;
    }

    public function getProduct($id)
    {
        $product = $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id')
            ->where('products.id', $id)
            ->first();

        if ($product) {
            $product['attributes'] = $this->getProductAttributes($id);
        }

        return $product;
    }

    private function getProductAttributes($productId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('product_attribute_values')
            ->select('attributes.name as attribute_name, attribute_values.value as attribute_value')
            ->join('attribute_values', 'attribute_values.id = product_attribute_values.attribute_value_id')
            ->join('attributes', 'attributes.id = attribute_values.attribute_id')
            ->where('product_attribute_values.product_id', $productId);

        return $builder->get()->getResultArray();
    }
}
