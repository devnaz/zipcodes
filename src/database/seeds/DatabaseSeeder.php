<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use MongoDB\BSON\UTCDateTime;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $zips = [
            [
                601,
                'Adjuntas',
            ],
            [
                602,
                'Aguada',
            ],
            [
                603,
                'Aguadilla',
            ],
            [
                606,
                'Maricao',
            ],
            [
                610,
                'Anasco',
            ],
            [
                612,
                'Arecibo',
            ],
            [
                616,
                'Bajadero',
            ],
            [
                617,
                'Barceloneta',
            ],
            [
                622,
                'Boqueron',
            ],
            [
                623,
                'Cabo Rojo',
            ],
            [
                624,
                'Penuelas',
            ],
            [
                627,
                'Camuy',
            ],
            [
                631,
                'Castaner',
            ],
            [
                637,
                'Sabana Grande',
            ],
            [
                638,
                'Ciales',
            ],
            [
                641,
                'Utuado',
            ],
            [
                646,
                'Dorado',
            ],
            [
                647,
                'Ensenada',
            ],
            [
                650,
                'Florida',
            ],
            [
                652,
                'Garrochales',
            ],
            [
                653,
                'Guanica',
            ],
            [
                656,
                'Guayanilla',
            ],
            [
                659,
                'Hatillo',
            ],
            [
                660,
                'Hormigueros',
            ],
            [
                662,
                'Isabela',
            ],
            [
                664,
                'Jayuya',
            ],
            [
                667,
                'Lajas',
            ],
            [
                669,
                'Lares',
            ],
            [
                670,
                'Las Marias',
            ],
            [
                674,
                'Manati',
            ],
            [
                676,
                'Moca',
            ],
            [
                677,
                'Rincon',
            ],
            [
                678,
                'Quebradillas',
            ],
            [
                680,
                'Mayaguez',
            ],
            [
                682,
                'Mayaguez',
            ],
            [
                683,
                'San German',
            ],
            [
                685,
                'San Sebastian',
            ],
            [
                687,
                'Morovis',
            ],
            [
                688,
                'Sabana Hoyos',
            ],
            [
                690,
                'San Antonio',
            ]
        ];

        foreach ($zips as $zip) {
            DB::table('zips')->insert([
                'zip' => $zip[0],
                'city' => $zip[1],
                'updated_at' => new UTCDateTime(Date::now()->format('Uv')),
                'created_at' => new UTCDateTime(Date::now()->format('Uv')),
            ]);
        }
    }
}
