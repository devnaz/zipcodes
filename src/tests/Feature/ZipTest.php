<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;
use App\Models\Zip;

class ZipTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        factory(Zip::class)->create([
            'zip' => 601,
            'city' => 'Adjuntas',
        ]);
        factory(Zip::class)->create([
            'zip' => 637,
            'city' => 'Sabana Grande',
        ]);
        factory(Zip::class)->create([
            'zip' => 638,
            'city' => 'Sabana Grands',
        ]);
        factory(Zip::class)->create([
            'zip' => 693,
            'city' => 'Vega Baja',
        ]);
        factory(Zip::class)->create([
            'zip' => 694,
            'city' => 'Vega Baja',
        ]);
        for ($i = 0; $i < 24; $i++) {
            factory(Zip::class)->create([
                'zip' => 800 + $i,
                'city' => 'Part ' . $i,
            ]);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testZipOk()
    {
        $response = $this->get('/api/v1/zip/code/00637');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(
            [
                'zip' => '00637',
                'city' => 'Sabana Grande',
            ],
            $response->json()
        );
    }

    public function testZipNotFound()
    {
        $response = $this->get('/api/v1/zip/code/00900');
        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testCityPartMatch1()
    {
        $response = $this->get('/api/v1/zip/city/Sabana Grande');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(
            [
                'data' =>
                    [
                        [
                            'zip' => '00637',
                            'city' => 'Sabana Grande',
                        ],
                    ],
                'links' =>
                    [
                        'first' => 'http://localhost:44444/api/v1/zip/city/Sabana Grande?page=1',
                        'last' => 'http://localhost:44444/api/v1/zip/city/Sabana Grande?page=1',
                        'prev' => NULL,
                        'next' => NULL,
                    ],
                'meta' =>
                    [
                        'current_page' => 1,
                        'from' => 1,
                        'last_page' => 1,
                        'path' => 'http://localhost:44444/api/v1/zip/city/Sabana Grande',
                        'per_page' => 20,
                        'to' => 1,
                        'total' => 1,
                    ],
            ],
            $response->json()
        );
    }

    public function testCityPartMatch2()
    {
        $response = $this->get('/api/v1/zip/city/Vega');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(
            [
                'data' =>
                    [
                        [
                            'zip' => '00693',
                            'city' => 'Vega Baja',
                        ],
                        [
                            'zip' => '00694',
                            'city' => 'Vega Baja',
                        ],
                    ],
                'links' =>
                    [
                        'first' => 'http://localhost:44444/api/v1/zip/city/Vega?page=1',
                        'last' => 'http://localhost:44444/api/v1/zip/city/Vega?page=1',
                        'prev' => NULL,
                        'next' => NULL,
                    ],
                'meta' =>
                    [
                        'current_page' => 1,
                        'from' => 1,
                        'last_page' => 1,
                        'path' => 'http://localhost:44444/api/v1/zip/city/Vega',
                        'per_page' => 20,
                        'to' => 2,
                        'total' => 2,
                    ],
            ],
            $response->json()
        );
    }


    public function testCityPartMatch3()
    {
        $response = $this->get('/api/v1/zip/city/part');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(
            [
                'data' =>
                    [
                        [
                            'zip' => '00800',
                            'city' => 'Part 0',
                        ],
                        [
                            'zip' => '00801',
                            'city' => 'Part 1',
                        ],
                        [
                            'zip' => '00810',
                            'city' => 'Part 10',
                        ],
                        [
                            'zip' => '00811',
                            'city' => 'Part 11',
                        ],
                        [
                            'zip' => '00812',
                            'city' => 'Part 12',
                        ],
                        [
                            'zip' => '00813',
                            'city' => 'Part 13',
                        ],
                        [
                            'zip' => '00814',
                            'city' => 'Part 14',
                        ],
                        [
                            'zip' => '00815',
                            'city' => 'Part 15',
                        ],
                        [
                            'zip' => '00816',
                            'city' => 'Part 16',
                        ],
                        [
                            'zip' => '00817',
                            'city' => 'Part 17',
                        ],
                        [
                            'zip' => '00818',
                            'city' => 'Part 18',
                        ],
                        [
                            'zip' => '00819',
                            'city' => 'Part 19',
                        ],
                        [
                            'zip' => '00802',
                            'city' => 'Part 2',
                        ],
                        [
                            'zip' => '00820',
                            'city' => 'Part 20',
                        ],
                        [
                            'zip' => '00821',
                            'city' => 'Part 21',
                        ],
                        [
                            'zip' => '00822',
                            'city' => 'Part 22',
                        ],
                        [
                            'zip' => '00823',
                            'city' => 'Part 23',
                        ],
                        [
                            'zip' => '00803',
                            'city' => 'Part 3',
                        ],
                        [
                            'zip' => '00804',
                            'city' => 'Part 4',
                        ],
                        [
                            'zip' => '00805',
                            'city' => 'Part 5',
                        ],
                    ],
                'links' =>
                    [
                        'first' => 'http://localhost:44444/api/v1/zip/city/part?page=1',
                        'last' => 'http://localhost:44444/api/v1/zip/city/part?page=2',
                        'prev' => NULL,
                        'next' => 'http://localhost:44444/api/v1/zip/city/part?page=2',
                    ],
                'meta' =>
                    [
                        'current_page' => 1,
                        'from' => 1,
                        'last_page' => 2,
                        'path' => 'http://localhost:44444/api/v1/zip/city/part',
                        'per_page' => 20,
                        'to' => 20,
                        'total' => 24,
                    ],
            ],
            $response->json()
        );
    }

    public function testCityPartMatch4()
    {
        $response = $this->get('/api/v1/zip/city/part?page=2');
        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals(
            [
                'data' =>
                    [
                        [
                            'zip' => '00806',
                            'city' => 'Part 6',
                        ],
                        [
                            'zip' => '00807',
                            'city' => 'Part 7',
                        ],
                        [
                            'zip' => '00808',
                            'city' => 'Part 8',
                        ],
                        [
                            'zip' => '00809',
                            'city' => 'Part 9',
                        ],
                    ],
                'links' =>
                    [
                        'first' => 'http://localhost:44444/api/v1/zip/city/part?page=1',
                        'last' => 'http://localhost:44444/api/v1/zip/city/part?page=2',
                        'prev' => 'http://localhost:44444/api/v1/zip/city/part?page=1',
                        'next' => NULL,
                    ],
                'meta' =>
                    [
                        'current_page' => 2,
                        'from' => 21,
                        'last_page' => 2,
                        'path' => 'http://localhost:44444/api/v1/zip/city/part',
                        'per_page' => 20,
                        'to' => 24,
                        'total' => 24,
                    ],
            ],
            $response->json()
        );
    }
}
