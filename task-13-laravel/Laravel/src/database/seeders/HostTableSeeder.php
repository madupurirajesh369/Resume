<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Host;

class HostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Host::factory(10)->create();
       /* $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('hosts')->insert([
                'name' => $faker->name,
                'email' => $faker->email,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }*/
    }
}
