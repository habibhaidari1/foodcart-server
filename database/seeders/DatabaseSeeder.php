<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MenuSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MetaSeeder::class);
        $this->call(OpeningHourSeeder::class);
        $this->call(MethodSeeder::class);
    }
}
