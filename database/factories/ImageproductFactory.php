<?php
    
    namespace Database\Factories;
    
    use App\Models\Imageproduct;
    use Illuminate\Database\Eloquent\Factories\Factory;
    
    class ImageproductFactory extends Factory
    {
        /**
         * The name of the factory's corresponding model.
         *
         * @var string
         */
        protected $model = Imageproduct::class;
        
        /**
         * Define the model's default state.
         */
        public function definition(): array
        {
            return [
            ];
        }
    }
