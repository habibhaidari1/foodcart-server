<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\OpeningHour;


class OpeningHourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function timeToInt($hour, $minute)
    {
        return ($hour * 60) + $minute;
    }

    public function run()
    {
        // 0 = Sonntag; 1 = Montag

        OpeningHour::create(['n' => 0, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(21, 40)]);

        OpeningHour::create(['n' => 2, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(14, 40)]);
        OpeningHour::create(['n' => 2, 'from' => $this->timeToInt(17, 0), 'to' => $this->timeToInt(21, 40)]);

        OpeningHour::create(['n' => 3, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(14, 40)]);
        OpeningHour::create(['n' => 3, 'from' => $this->timeToInt(17, 0), 'to' => $this->timeToInt(21, 40)]);

        OpeningHour::create(['n' => 4, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(14, 40)]);
        OpeningHour::create(['n' => 4, 'from' => $this->timeToInt(17, 0), 'to' => $this->timeToInt(21, 40)]);

        OpeningHour::create(['n' => 5, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(14, 40)]);
        OpeningHour::create(['n' => 5, 'from' => $this->timeToInt(17, 0), 'to' => $this->timeToInt(21, 40)]);

        OpeningHour::create(['n' => 6, 'from' => $this->timeToInt(11, 0), 'to' => $this->timeToInt(14, 40)]);
        OpeningHour::create(['n' => 6, 'from' => $this->timeToInt(17, 0), 'to' => $this->timeToInt(21, 40)]);

    }
}
