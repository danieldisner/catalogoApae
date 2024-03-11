<?php
namespace Database\Factories;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $productName = $this->faker->randomElement([
            'Camiseta',
            'Calça',
            'Tênis',
            'Jaqueta',
            'Bermuda',
        ]) . ' ' . $this->faker->unique()->word(); // Adiciona uma palavra aleatória para tornar o nome mais único

        $price = $this->faker->randomFloat(2, 10, 500);
        $description = $this->faker->paragraph(3);

        $product = Product::create([
            'name' => ucfirst($productName),
            'price' => $price,
            'description' => $description,
        ]);

        // Criar imagens e associá-las ao produto
        $imageIds = Image::factory()->count(rand(1, 5))->create()->pluck('id')->toArray();
        $product->images()->sync($imageIds);

        return $product->toArray();
    }

    public function configure()
{
    return $this->afterCreating(function (Product $product) {
        $product->images()->saveMany(Image::factory()->count(rand(1, 5))->make());
    });
}
}
