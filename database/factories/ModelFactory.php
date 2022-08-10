
<?php

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $this->faker->word,
        'price' => $this->faker->text,
        'description' => $faker->text,
    ];
});
