<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->randomElement([
            'Cải xanh', 'Cà rốt', 'Khoai tây', 'Cà chua',
            'Xà lách', 'Táo', 'Xoài', 'Cam', 'Chuối',
            'Thịt heo', 'Thịt bò', 'Thịt gà', 'Sườn non',
            'Cá hồi', 'Tôm sú', 'Mực ống', 'Cua biển',
            'Trứng gà', 'Gạo', 'Sữa tươi', 'Mì gói',
        ]);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1,1000),
            'category_id' => Category::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2,10000,200000),
            'stock' => $this->faker->numberBetween(0,100),
            'status' => $this->faker->randomElement(['in_stock', 'out_of_stock']),
            'unit' => $this->faker->randomElement(['kg', 'bó', 'túi', 'hộp']),

        ];
    }
}
