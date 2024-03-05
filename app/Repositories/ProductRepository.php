<?php
    namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;


interface ProductRepository
{
    public function add(ProductRequest $request) : Product;
}
