<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('images')->paginate(Auth::check() ? 20 : 6);
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

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image separately
        ]);

        // Create the product
        $product = Product::create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
        ]);

        // Handle product images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image
                $path = $image->store('images','public');
                // Create image record in the database
                $product->images()->create(['path' => $path]);
            }
        }

        // Redirect back with success message

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function destroy($id)
    {
        // Find the product by its ID
        $product = Product::findOrFail($id);

        // Delete the images associated with the product
        foreach ($product->images as $image) {
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            // Delete image from database
            $image->delete();
        }

        // Delete the product
        $product->delete();

        // Redirect back with success message
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
