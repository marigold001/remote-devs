<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Controller;

class ProductController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $data['products'] = $productModel->getProducts();
        return view('products/index', $data);
    }

    public function show($id)
    {
        $productModel = new ProductModel();
        $data['product'] = $productModel->getProduct($id);
        return view('products/show', $data);
    }
}
