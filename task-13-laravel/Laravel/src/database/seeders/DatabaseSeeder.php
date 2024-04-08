<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // \App\Models\Product::factory(10)->create();
       // \App\Models\Host::factory(10)->create();
       // \App\Models\Project::factory(10)->create();
        Model::unguard();
        $this->call([
            UsersTableSeeder::class,
            BooksTableSeeder::class,
            HostTableSeeder::class,
            ProjectTableSeeder::class,
            ProductsTableSeeder::class,
        ]);
    }
}
