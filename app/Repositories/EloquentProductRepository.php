<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class EloquentProductRepository implements ProductRepository
{
    public function add(ProductRequest $request) : Product
    {
       return $product = DB::transaction(function() use ($request) {
            $product = Product::create([
                'name' => $request->name,
                'cover' => $request->coverPath
                ]
            );
            /*
            $images = [];
            for ($i = 1; $i <= $request->images->count(); $i++) {
                $images[] = [
                    'product_id' => $product->id,
                    'path' => $i,
                ];
            }
            Image::insert($images);
            */
            return $product;
        });

    }
}
