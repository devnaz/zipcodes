<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\ImportResource;
use Illuminate\Http\Response;
use Prophecy\Prophecy\MethodProphecy;
use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ImportResourceTest extends TestCase
{

    private $importResource;

    protected function setUp(): void
    {
        parent::setUp();
        $this->importResource = new ImportResource();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->importResource = null;
    }

    public function testToArray()
    {
        $this->assertEquals(
            [],
            $this->importResource->toArray(null)
        );
    }

    public function testWithResponse()
    {
        $request = $this->prophesize(Request::class);

        $response = $this->prophesize(JsonResponse::class);
        $response
            ->addMethodProphecy(
                (new MethodProphecy(
                    $response,
                    'setStatusCode',
                    [Response::HTTP_NO_CONTENT]
                ))->willReturn(null)
            );

        $this->assertNull(
            $this->importResource->withResponse(
                $request->reveal(),
                $response->reveal(),
                )
        );
    }
}
