<?php
namespace Database\Factories;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition()
    {
        // Gerar uma imagem aleatória e salvar no servidor
        $imagePath = $this->faker->image(storage_path('app/public/images'), 400, 300, null, false);

        // Armazenar o caminho da imagem no campo 'path'
        return [
            'path' => 'public/images/' . $imagePath, // Salva o caminho da imagem no campo 'path'
            'product_id' => Product::factory()->create()->id, // Cria um produto e associa a imagem a ele
        ];
    }
}
