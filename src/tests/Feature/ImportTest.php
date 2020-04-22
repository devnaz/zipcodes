<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTest extends TestCase
{

    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testImport()
    {
        $response = $this->get('/api/v1/zip/code/00999');
        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $file = UploadedFile::fake()
            ->createWithContent('uszips.csv', 'id,zip,city' . PHP_EOL . '1,"00999","Test city"');
        $response = $this->post(
            '/api/v1/import/file-csv',
            [
                'db' => $file
            ],
            [
                'Accept: application/json',
                'Content-Type: multipart/form-data'
            ]
        );
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertEmpty($response->getContent());
        sleep(2);

        $response = $this->get('/api/v1/zip/code/00999');
        $response->assertStatus(Response::HTTP_OK);

        $this->assertEquals(
            [
                'zip' => '00999',
                'city' => 'Test city',
            ],
            $response->json()
        );
    }
}
