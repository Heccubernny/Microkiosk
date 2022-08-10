<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use ProductsTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->call([ProductsTableSeeder::class]);
        factory(App\Models\Product::class, 10)->create();
    }
}
