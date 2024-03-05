<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::paginate(15);
        $mensagemSucesso = session('mensagem.sucesso');

        return view('product.index')->with('products', $products)
        ->with('mensagemSucesso', $mensagemSucesso);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $images = $product->images;
        return view('product.show')->with('product', $product)->with('images',$images);
    }
}
