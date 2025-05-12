<?php

namespace Database\Seeders;

use App\Models\Mall;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $malls = [
            [
                'name' => 'City Center Mall',
                'location' => 'Downtown Area',
                'description' => 'The largest shopping destination in the city.'
            ],
            [
                'name' => 'Waterfront Mall',
                'location' => 'Harbor District',
                'description' => 'Luxury shopping with ocean views.'
            ],
            [
                'name' => 'Plaza Mall',
                'location' => 'City Square',
                'description' => 'Modern shopping experience in the heart of the city.'
            ],
            [
                'name' => 'Galleria Mall',
                'location' => 'Fashion District',
                'description' => 'Home to the most exclusive fashion brands.'
            ]
        ];

        foreach ($malls as $mallData) {
            $mall = Mall::create($mallData);
            
            // Create sample products for each mall
            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'name' => "Product {$i} - {$mall->name}",
                    'description' => "This is a sample product {$i} from {$mall->name}",
                    'price' => rand(999, 9999) / 100,
                    'image_url' => "https://picsum.photos/seed/{$mall->id}-{$i}/800/600",
                    'mall_id' => $mall->id
                ]);
            }
        }
    }
}
