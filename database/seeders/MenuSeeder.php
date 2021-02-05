<?php
namespace Database\Seeders;

use App\Category;
use App\ExtraGroup;
use App\Food;
use App\VariationGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\URL;

class MenuSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //VARIATIONSGRUPPEN und VARIATIONEN
        $sauce = VariationGroup::create(
            ['name' => 'Sauce',
                'variations' => [
                    ['name' => 'mit Ketchup'],
                    ['name' => 'mit Mayonnaise'],
                    ['name' => 'ohne Sauce'],
                ],
            ]);

        $beilage = VariationGroup::create(
            ['name' => 'Beilage',
                'variations' =>
                [
                    ['name' => 'mit Reis, gekocht'],
                    ['name' => 'mit Nudeln, gebraten'],
                    ['name' => 'mit Reis, gebraten'],
                    ['name' => 'ohne Beilage'],
                ],
            ]);

        $sauce2 = VariationGroup::create(
            [
                'name' => 'Sauce', 'variations' => [
                    ['name' => 'mit Currysauce'],
                    ['name' => 'mit Erdnusssauce'],
                    ['name' => 'mit Süß-Sauer-Sauce'],
                    ['name' => 'ohne Sauce'],
                ],
            ]);

        //EXTRAGRUPPEN
        $extragrp = ExtraGroup::create();
        /*
        $extragrp->extras()->createMany([
            ['name' => 'Flaschenöffner', 'price' => '100'],
            ['name' => 'Wassersprudler', 'price' => '200'],
            ['name' => 'ohne Aufdruck', 'price' => '400'],
        ]);
        */
        // KATEGORIEN
        $ct = Category::create(
            [
                'name' => 'Vorspeisen',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/2.jpg',
                'sorting' => 1,
            ]
        );

        $ct->bulkAttachFood([
            [
                'name' => 'Chicken-Sommerrollen',
                'description' => '2 Stück, mit Hühnerbrust und Salat in Reispapier gerollt',
                'number' => '7',
                'variants' => [['price' => 550, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Gebackener Tofu',
                'description' => 'mit Süß-Sauer-Sauce',
                'number' => '8',
                'variants' => [['price' => 290, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Gebackenes Gemüse',
                'description' => 'mit Süß-Sauer-Sauce',
                'number' => '9',
                'variants' => [['price' => 290, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Asia Frühlingsrolle',
                'number' => '10a',
                'variants' => [['price' => 210, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Vegetarische Frühlingsrollen',
                'description' => '6 Stück',
                'number' => '10b',
                'variants' => [['price' => 200, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Kroepoek',
                'number' => '11',
                'variants' => [['price' => 150, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Gebackene Wantan',
                'description' => '8 Stück gefüllte Teigtaschen mit Süß-Sauer-Sauce',
                'number' => '12',
                'variants' => [['price' => 320, 'tax_rate' => 7, 'default' => true]],
            ],
            [
                'name' => 'Pommes Frites',
                'number' => '13',
                'variationGroups' => [$sauce],
                'variants' => [
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$sauce->variations->get(0)],
                    ],
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$sauce->variations->get(1)],
                    ],
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$sauce->variations->get(2)],
                    ],
                ],
            ]]);

        $ct = Category::create(
            [
                'name' => 'Suppen',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/1.jpg',
                'sorting' => 2,
            ]
        );

        $ct->bulkAttachFood([
            [
                'name' => 'Hühnerfleischsuppe',
                'description' => 'mit Champignons und Spargel',
                'number' => '1',
                'variants' =>
                [
                    [
                        'price' => 290, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Peking Gulaschsuppe',
                'description' => 'sauer-scharf',
                'number' => '2',
                'variants' => [[
                    'price' => 250, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Wantan Suppe',
                'description' => 'Teigtaschen gefüllt mit Hackfleisch',
                'number' => '3',
                'variants' =>
                [[
                    'price' => 290, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gemüsesuppe',
                'description' => 'mit Tofu',
                'number' => '5',
                'variants' =>
                [[
                    'price' => 250, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            ['name' => 'Asia Nudelsuppe Topf',
                'description' => 'mit Hühnerfleisch, Schinken, Gemüse und Krabben',
                'number' => '6',
                'variants' =>
                [[
                    'price' => 480, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ]]);
        $ct = Category::create(
            [
                'name' => 'Salate',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/3.jpg',
                'sorting' => 3,
            ]);
        $ct->bulkAttachFood([
            [
                'name' => 'Hühnerfleischsalat',
                'number' => '16',
                'variants' =>
                [[
                    'price' => 370, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Tomatensalat',
                'number' => '17',
                'variants' =>
                [[
                    'price' => 290, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gemischter Salat',
                'number' => '18',
                'variants' =>
                [[
                    'price' => 250, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Tofusalat',
                'description' => 'mit Kohlsalat, Gurken und Erdnusssauce',
                'number' => '19',
                'variants' =>
                [[
                    'price' => 370, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
        ], );
        $ct = Category::create(
            [
                'name' => 'Gebratene Nudeln',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/6.jpg',
                'sorting' => 4,
            ]);
        $ct->bulkAttachFood([
            [
                'name' => 'Gebratene Nudeln mit Gemüse',
                'number' => '40',
                'variants' =>
                [[
                    'price' => 490, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Hühnerfleisch und Gemüse',
                'number' => '41',
                'variants' =>
                [[
                    'price' => 730, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Hühnerfleisch, Gemüse und Curry',
                'number' => '42',
                'variants' =>
                [[
                    'price' => 750, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Rindfleisch und Gemüse',
                'number' => '43',
                'variants' =>
                [[
                    'price' => 760, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Rindfleisch, Gemüse und Curry',
                'number' => '44',
                'variants' =>
                [[
                    'price' => 770, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Krabben und Gemüse',
                'number' => '45',
                'variants' =>
                [[
                    'price' => 760, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit Hummerkrabben',
                'number' => '47',
                'variants' =>
                [[
                    'price' => 950, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Bami-Goreng Spezial',
                'description' => 'gebratene Nudeln mit Hühnerfleisch, Schinken und Krabben',
                'number' => '48',
                'variants' =>
                [[
                    'price' => 890, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratene Nudeln mit gebackener Ente und Gemüse',
                'number' => '49',
                'variants' =>
                [[
                    'price' => 990, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
        ]);
        $ct = Category::create(
            [
                'name' => 'Reisgerichte',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/5.jpg',
                'sorting' => 5,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebratener Eierreis mit Gemüse',
                'number' => '30',
                'variants' =>
                [[
                    'price' => 490, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Hühnerfleisch und Gemüse',
                'number' => '31',
                'variants' =>
                [[
                    'price' => 650, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Hühnerfleisch, Gemüse und Curry',
                'number' => '32',
                'variants' =>
                [[
                    'price' => 670, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Rindfleisch und Gemüse',
                'number' => '33',
                'variants' =>
                [[
                    'price' => 670, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Rindfleisch, Gemüse und Curry',
                'number' => '34',
                'variants' =>
                [[
                    'price' => 690, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Krabben und Gemüse',
                'number' => '35',
                'variants' =>
                [[
                    'price' => 670, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit Hummerkrabben und Gemüse',
                'number' => '36',
                'variants' =>
                [[
                    'price' => 950, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Nasi-Goreng Spezial',
                'description' => 'gebratener Eierreis mit Hühnerfleisch, Schinken und Krabben',
                'number' => '38',
                'variants' =>
                [[
                    'price' => 850, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
            [
                'name' => 'Gebratener Eierreis mit gebackener Ente und Gemüse',
                'number' => '39',
                'variants' =>
                [[
                    'price' => 980, 'tax_rate' => 7,
                    'default' => true,
                ]],
            ],
        ], );
        $ct = Category::create(
            [
                'name' => 'Schweinefleischgerichte',
                'type' => Category::CATEGORY_TYPE_LIST,
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'image' => URL::to('/') . '/images/7.jpg',
                'sorting' => 6,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebratenes Schweinefleisch rotes Curry',
                'description' => 'mit rotem Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '53',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ]
            ,
            [
                'name' => 'Gebratenes Schweinefleisch gelbes Curry',
                'description' => 'mit gelbem Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '54',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Schweinefleisch Hoisin',
                'description' => 'mit Hoisin-Sauce und Gemüse',
                'number' => '55',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Schweinefleisch mit Knoblauch, Pfeffer und Kohlsalat',
                'number' => '56',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Schweinefleisch Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '57',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 670, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 670 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 670 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 670, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Schweinefleisch mit Gemüse nach Thai-Art',
                'description' => 'scharf',
                'number' => '59',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 730, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 730 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 730 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 730, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ]]);
        $ct = Category::create(
            [
                'name' => 'Hühnerfleischgerichte',
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/8.jpg',
                'sorting' => 7,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebackenes Hühnerbrustfilet Curry',
                'description' => 'paniertes Hühnerbrustfilet mit Curry, Kokosmilch und Kohlsalat',
                'number' => '60',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebackenes Hühnerbrustfilet Süß-sauer',
                'description' => 'paniertes Hühnerbrustfilet mit Süß-Sauer-Sauce und Salat',
                'number' => '61',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebackenes Hühnerbrustfilet Erdnusssauce',
                'description' => 'paniertes Hühnerbrustfilet mit Erdnusssauce und Salat',
                'number' => '62',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 650 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 650, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet rotes Curry',
                'description' => 'mit roten Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '63',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet gelbes Curry',
                'description' => 'mit gelbem Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '64',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet Hoisin',
                'description' => 'mit Hoisin-Sauce und Gemüse',
                'number' => '65',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '67',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet mit Gemüse nach Thai-Art',
                'number' => '68',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Knusprige Hühnerbrust',
                'description' => 'paniert und in Scheiben mit Gemüse und Sauce nach Wahl',
                'number' => '69',
                'variationGroups' => [$beilage, $sauce2],
                'variants' => [
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0), $sauce2->variations->get(0)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1), $sauce2->variations->get(0)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2), $sauce2->variations->get(0)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3), $sauce2->variations->get(0)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(0), $sauce2->variations->get(1)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1), $sauce2->variations->get(1)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2), $sauce2->variations->get(1)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3), $sauce2->variations->get(1)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(0), $sauce2->variations->get(2)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1), $sauce2->variations->get(2)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2), $sauce2->variations->get(2)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3), $sauce2->variations->get(2)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(0), $sauce2->variations->get(3)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1), $sauce2->variations->get(3)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2), $sauce2->variations->get(3)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3), $sauce2->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratenes Hühnerbrustfilet Spezial',
                'description' => 'mit Curry und Gemüse',
                'number' => '69a',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 720 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 720, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
        ], );

        $ct = Category::create(
            [
                'name' => 'Rindfleischgerichte',
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/9.jpg',
                'sorting' => 8,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebratenes Rindfleisch Hoisin',
                'description' => 'mit Hoisin-Sauce und Gemüse',
                'number' => '73',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratenes Rindfleisch gelbes Curry',
                'description' => 'mit gelbem Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '74',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratenes Rindfleisch rotes Curry',
                'description' => 'mit rotem Curry, Kokosmilch und Gemüse nach Thai-Art',
                'number' => '75',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 750 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 750, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratenes Rindfleisch Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '77',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 790 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 790 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 790, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratenes Rindfleisch mit Gemüse nach Thai-Art',
                'number' => '79',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 790 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 790 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 790, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
        ], );
        $ct = Category::create(
            [
                'name' => 'Entenfleischgerichte',
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/10.jpg',
                'sorting' => 9,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebackene Ente mit Süß-Sauer-Sauce und Kohlsalat',
                'number' => '80',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente mit gelbem Curry, Kokosmilch und Gemüse',
                'number' => '81',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente mit Erdnusssauce und Gemüse',
                'number' => '82',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente mit Sojakeimen und Sojasauce',
                'description' => 'leicht scharf',
                'number' => '83',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 930 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 930, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '84',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente Gemüse',
                'description' => 'scharf, mit Bambus, Zwiebeln, Morcheln, Lauch, Karotten und Paprika nach Thai Art',
                'number' => '85',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebackene Ente rotes Curry',
                'description' => 'scharf, mit rotem Curry, Ananas, Tomaten und Gemüse',
                'number' => '87',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 990 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 990, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
        ], );
        $ct = Category::create(
            [
                'name' => 'Meeresfrüchtegerichte',
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/11.jpg',
                'sorting' => 10,
            ]
        );
        $ct->bulkAttachFood([

            [
                'name' => 'paniertes Rotbarschfilet mit Süß-Sauer-Sauce und Gemüse',
                'number' => '88',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Paniertes Rotbarschfilet mit Currysauce und Gemüse',
                'number' => '89',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Paniertes Rotbarschfilet mit Sojasauce und Gemüse',
                'number' => '90',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 690 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 690, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratener Tintenfisch Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '94',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 730, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 730 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 730 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 730, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratene Hummerkrabben Chop Suey',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '96',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 890, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 890 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 890 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 890, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratene Hummerkrabben und Tintenfische',
                'number' => '97',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 950, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 950 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 950 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 950, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
            [
                'name' => 'Gebratene Hummerkrabben mit Süß-Sauer-Sauce und Gemüse',
                'number' => '98',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 890, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 890 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 890 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 890, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ]],
        ], );
        $ct = Category::create(
            [
                'name' => 'Satey',
                'description' => 'Alle Gerichte werden mit mit Chili-Erdnusssauce, Kohlsalat und Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/4.jpg',
                'sorting' => 11,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Hühnerfleischspieße',
                'number' => '20',
                'variants' => [
                    [
                        'price' => 770, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
        ], );
        $ct = Category::create(
            [
                'name' => 'Vegetarische Gerichte',
                'description' => 'Alle Gerichte werden mit Reis serviert.',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/12.jpg',
                'sorting' => 12,
            ]
        );
        $ct->bulkAttachFood([
            [ // korrigiert 2.juli
                'name' => 'Gebratene Gemüsepfanne',
                'description' => 'mit Beilagen nach Wahl',
                'number' => '100',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 590, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 590 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 590 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 590, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Tofu',
                'description' => 'mit verschiedenem Gemüse',
                'number' => '101',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Tofu gelbes Curry',
                'description' => 'leicht scharf, mit gelbem Curry und Gemüse nach Thai-Art',
                'number' => '102',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Tofu rotes Curry',
                'description' => 'leicht scharf, mit rotem Curry und Gemüse nach Thai Art',
                'number' => '103',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratene Nudeln',
                'description' => 'mit Tofu und Gemüse, ohne Reis',
                'number' => '104',
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Tofu mit Gemüse nach Thai-Art',
                'number' => '105',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Tofu mit Gemüse und Erdnusssauce',
                'number' => '107',
                'variationGroups' => [$beilage],
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                        'variations' => [$beilage->variations->get(0)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(1)],
                    ],
                    [
                        'price' => 620 + 180, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(2)],
                    ],
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => false,
                        'variations' => [$beilage->variations->get(3)],
                    ],
                ],
            ],
            [
                'name' => 'Gebratener Eierreis mit Tofu und Gemüse',
                'number' => '108',
                'variants' => [
                    [
                        'price' => 620, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],

        ], );
        $ct = Category::create(
            [
                'name' => 'Extras',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/5.jpg',
                'sorting' => 13,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gekochter Reis',
                'variants' => [
                    [
                        'price' => 150, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Erdnusssauce', 'variants' => [
                    [
                        'price' => 150, 'tax_rate' => 7,
                        'default' => true,
                    ]],

            ],
            [
                'name' => 'Currysauce', 'variants' => [
                    [
                        'price' => 150, 'tax_rate' => 7,
                        'default' => true,
                    ]],

            ],
            [
                'name' => 'Süß-Saure Sauce', 'variants' => [
                    [
                        'price' => 150, 'tax_rate' => 7,
                        'default' => true,
                    ]],

            ],
            [
                'name' => 'Sojasauce', 'variants' => [
                    [
                        'price' => 50, 'tax_rate' => 7,
                        'default' => true,
                    ]],

            ],
            [
                'name' => 'Sambal-Oelek', 'variants' => [
                    [
                        'price' => 50, 'tax_rate' => 7,
                        'default' => true,
                    ]],

            ],
        ]);
        $ct = Category::create(
            [
                'name' => 'Dessert',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/13.jpg',
                'sorting' => 14,
            ]
        );
        $ct->bulkAttachFood([
            [
                'name' => 'Gebackene Banane',
                'description' => 'mit Honig',
                'number' => '110',
                'variants' => [
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Gebackene Ananas',
                'description' => 'mit Honig',
                'number' => '111',
                'variants' => [
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Gebackener Apfel',
                'description' => 'mit Honig',
                'number' => '112',
                'variants' => [
                    [
                        'price' => 190, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ]
                ,
            ],
            [
                'name' => 'Gebackene Banane, Ananas und Apfel',
                'description' => 'mit Honig',
                'number' => '113',
                'variants' => [
                    [
                        'price' => 240, 'tax_rate' => 7,
                        'default' => true,
                    ],
                ],
            ],
        ]);
        $ct = Category::create(
            [
                'name' => 'Alkoholfreie Getränke',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/14.jpg',
                'sorting' => 15,
            ]
        );

        $ct->bulkAttachFood([

            [
                'name' => 'Mangosaft 0,25l',
                'number' => '115',
                'variants' => [
                    [
                        'price' => 200, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Vitamalz Bier 0,33l',
                'description' => 'alkoholfrei, inkl. Pfand (0,08 €)',
                'number' => '117',
                'variants' => [
                    [
                        'price' => 200, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Guavasaft 0,25l',
                'number' => '115',
                'variants' => [
                    [
                        'price' => 200, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Lycheesaft 0,25l',
                'number' => '115',
                'variants' => [
                    [
                        'price' => 200, 'tax_rate' => 19,
                        'default' => true,
                    ]]],
            [
                'name' => 'Einbecker alkoholfreies Bier 0,33l',
                'number' => '119'
                , 'variants' => [
                    [
                        'price' => 180, 'tax_rate' => 19,
                        'default' => true,
                    ]], 'description' => 'inkl. Pfand (0,08 €)'],
            [
                'name' => 'Kokossaft 0,25l',
                'number' => '115',
                'variants' => [
                    [
                        'price' => 200, 'tax_rate' => 19,
                        'default' => true,
                    ]]],
            [
                'name' => 'Coca Cola 1,0l',
                'number' => '116',
                'description' => 'inkl. Pfand (0,15 €)',
                'variants' => [
                    [
                        'price' => 250, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Fanta 1,0l',

                'number' => '116',
                'description' => 'inkl. Pfand (0,15 €)',
                'variants' => [
                    [
                        'price' => 250, 'tax_rate' => 19,
                        'default' => true,
                    ]],
            ],
            [
                'name' => 'Sprite 1,0l',
                'number' => '116',
                'description' => 'inkl. Pfand (0,15 €)',
                'variants' => [
                    [
                        'price' => 250, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],

            [
                'name' => 'Wasser 1,0l',
                'number' => '114',
                'description' => 'inkl. Pfand (0,15 €)',
                'variants' => [
                    [
                        'price' => 220, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
        ], );
        $ct = Category::create(
            [
                'name' => 'Alkoholische Getränke',
                'type' => Category::CATEGORY_TYPE_LIST,
                'image' => URL::to('/') . '/images/14.jpg',
                'sorting' => 16,
            ]
        );

        $ct->bulkAttachFood([
            [
                'name' => 'Einbecker Bier 0,33l',
                'number' => '119',
                'description' => '5,0% vol inkl. Pfand (0,08 €)',
                'variants' => [
                    [
                        'price' => 180, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Hefeweizen 0,5l',
                'description' => '4,5% volinkl. Pfand (0,08 €)',
                'number' => '120',
                'variants' => [
                    [
                        'price' => 220, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Pflaumenwein 0,5l',
                'description' => '10% vol.',
                'number' => '121',
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Pflaumenwein 0,75l',
                'description' => '9,7% vol.',
                'number' => '121',
                'variants' => [
                    [
                        'price' => 890, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Lycheewein 0,75l',
                'description' => '9,7% vol.',
                'number' => '122',
                'variants' => [
                    [
                        'price' => 850, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Reiswein Sake 0,75l',
                'description' => '38,0% vol.',
                'number' => '123',
                'variants' => [
                    [
                        'price' => 950, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Tsing Tao rot 0,75l',
                'description' => '13% vol',
                'number' => '124',
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Bambusschnaps 0,5l',
                'description' => '9,7% vol',
                'number' => '126',
                'variants' => [
                    [
                        'price' => 1500, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Französischer Rotwein 0,75l',
                'description' => '10,0% vol',
                'number' => '127',
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],
            [
                'name' => 'Französischer Weißwein 0,75l',
                'description' => '9,7% vol',
                'number' => '127',
                'variants' => [
                    [
                        'price' => 790, 'tax_rate' => 19,
                        'default' => true,
                    ],
                ],
            ],

        ]);

        // HIGHLIGHTS
        $ct = Category::create(
            [
                'name' => 'Highlights',
                'description' => 'Entdecke unsere Bestseller',
                'type' => Category::CATEGORY_TYPE_CARDS,
                'sorting' => 0,
                'food' => [

                ],
            ]
        );

        $ct->food()->attach(Food::where('number', '=', '1')->first());
        $ct->food()->attach(Food::where('number', '=', '54')->first());
        $ct->food()->attach(Food::where('number', '=', '3')->first());
        $ct->food()->attach(Food::where('number', '=', '5')->first());
        $ct->food()->attach(Food::where('number', '=', '6')->first());
        $ct->food()->attach(Food::where('number', '=', '16')->first());
        $ct->food()->attach(Food::where('number', '=', '17')->first());
        $ct->food()->attach(Food::where('number', '=', '18')->first());

    }
}
