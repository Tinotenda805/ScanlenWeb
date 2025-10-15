<?php

namespace Database\Factories;

use App\Models\OurPeople;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurPeople>
 */
class OurPeopleFactory extends Factory
{
    protected $model = OurPeople::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->name();
         return [
            'name' => $name,
            'type' => $this->faker->randomElement(['associate', 'partner']),
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->randomNumber(3),
            'email' => $this->faker->unique()->safeEmail(),
            'bio' => $this->faker->paragraphs(3, true),
            'avatar' => $this->faker->optional()->imageUrl(200, 200, 'people'),
            'twitter' => $this->faker->optional()->userName(),
            'linkedin' => $this->faker->optional()->userName(),
            'whatsapp' => $this->faker->optional()->phoneNumber(),
            'facebook' => $this->faker->optional()->userName(),
            'phone' => $this->faker->optional()->phoneNumber(),
        ];
    }
}
