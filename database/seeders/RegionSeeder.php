<?php
namespace Database\Seeders;

use App\Postcode;
use App\Rate;
use App\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kassel 1
        $region = Region::create();
        Postcode::where('postcode', '34131')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34130')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34127')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34125')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34119')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34117')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34121')->first()->region()->associate($region)->save();
        $rate = Rate::create(['costs'=>100, 'minimum'=>1000]);
        $region->rates()->attach($rate);
        $rate = Rate::create(['costs'=>0, 'minimum'=>2000]);
        $region->rates()->attach($rate);

        // Kassel 2
        $region = Region::create();
        Postcode::where('postcode', '34134')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34132')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34128')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34123')->first()->region()->associate($region)->save();
        $rate = Rate::create(['costs'=>200, 'minimum'=>1000]);
        $region->rates()->attach($rate);
        $rate = Rate::create(['costs'=>0, 'minimum'=>2000]);
        $region->rates()->attach($rate);


        // Kassel 3
        $region = Region::create();
        Postcode::where('postcode', '34246')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34225')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34270')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34292')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34277')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34225')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34233')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34260')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34266')->first()->region()->associate($region)->save();
        Postcode::where('postcode', '34253')->first()->region()->associate($region)->save();
        $rate = Rate::create(['costs'=>200, 'minimum'=>3000]);
        $region->rates()->attach($rate);
        $rate = Rate::create(['costs'=>0, 'minimum'=>4000]);
        $region->rates()->attach($rate);




 }
}
