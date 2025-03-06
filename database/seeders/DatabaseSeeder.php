<?php
    
    namespace Database\Seeders;
    
    use App\Models\Category;
    use App\Models\Generaloptions;
    use App\Models\Product;
    use App\Models\Tag;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    
    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            
            User::factory()->create([
              'name' => 'Juan Jota',
              'email' => 'esnola@gmail.com',
              'password' => Hash::make('12345678')
            ]);
            
            User::factory(30)->create();
            
            Generaloptions::factory()->create([
              'name' => 'hide_no_actives',
              'value' => 0
            ]);
            Generaloptions::factory()->create([
              'name' => 'hide_no_existences',
              'value' => 0
            ]);
            
            for ($i = 0; $i < 5; $i++) {
                Category::factory()->create([
                  'name' => fake()->firstName(),
                  'color' => fake()->colorName(),
                  'bgcolor' => fake()->colorName(),
                ]);
            }
            for ($i = 0; $i < 15; $i++) {
                Tag::factory()->create([
                  'name' => fake()->firstName(),
                  'color' => fake()->colorName(),
                  'bgcolor' => fake()->colorName(),
                  'category_id' => rand(1, 5),
                  'icon_active' => fake()->boolean(),
                ]);
            }
            for ($i = 0; $i < 250; $i++) {
                Product::factory()->create([
                  'name' => fake()->firstName(),
                  'description' => fake()->paragraph(5),
                  'price' => rand(1000, 125000),
                  'oferta' => fake()->boolean(),
                  'descuento' => rand(5, 85),
                  'units' => rand(0, 25),
                    //'tag_id' => rand(1, 10),
                  'user_id' => rand(1, 10),
                  'active' => fake()->boolean(),
                ]);
            }
        }
    }
