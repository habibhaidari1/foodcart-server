<?php
namespace Database\Seeders;

use App\Method;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Method::create(['id' => Method::METHOD_ID_CASH, 'name' => 'Barzahlung bei Lieferung', 'default' => true, 'active' => true]);
        Method::create(['id' => Method::METHOD_ID_CARD, 'name' => 'Kartenzahlung bei Lieferung', 'default' => false, 'active' => true]);
        Method::create(['id' => Method::METHOD_ID_PAYPAL, 'name' => 'PayPal', 'default' => false, 'active' => true]);
    }
}
