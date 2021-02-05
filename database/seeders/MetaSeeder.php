<?php
namespace Database\Seeders;

use App\Meta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meta::create(['name' => 'name', 'value' => 'Ein asiatisches Restaurant']);
        Meta::create(['name' => 'representative', 'value' => 'Maxine Mustermann']);
        Meta::create(['name' => 'street', 'value' => 'Musterstraße 1']);
        Meta::create(['name' => 'city', 'value' => '12345 Musterstadt']);
        Meta::create(['name' => 'country', 'value' => 'Deutschland']);
        Meta::create(['name' => 'vat_id', 'value' => '012/345/67890']);
        Meta::create(['name' => 'authority', 'value' => 'OA Musterstadt']);
        Meta::create(['name' => 'description', 'value' => 'Freuen Sie sich auf ein exzellentes, uriges und ländliches Pub, das im wunderschönen Dorf Peasemore in der englischen Grafschaft Berkshire von den preisgekrönten Inhabern liebevoll geführt wird. In der Nähe der A34 sowie der Abfahrten 13 und 14 der M4 erwartet Sie ein charmantes und rustikales Gebäude mit einer passenden Einrichtung, die auch mit eleganten und modernen Elementen besticht. ']);
        Meta::create(['name' => 'contact_tel', 'value' => 'tel:+4912345678909']);
        // Meta::create(['name' => 'contact_mail', 'value' => 'mailto:bestellung@lieferservice.de']);
        Meta::create(['name' => 'closed', 'value' => '0']);
        Meta::create(['name' => 'allergens', 'value' => URL::to('/') . '/docs/speisekarte.pdf']);
        // Meta::create(['name' => 'contact_bug', 'value' => 'mailto:habibhaidari@outlook.com']);
        // Meta::create(['name' => 'allergens', 'value' => URL::to('/') . '/docs/speisekarte.pdf']);
        // Meta::create(['name' => 'logo', 'value' => URL::to('/') . '/images/logo.png']);

    }
}
