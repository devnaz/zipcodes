<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\ZipResource;
use Prophecy\Prophecy\MethodProphecy;
use Tests\TestCase;
use App\Models\Zip;

class ZipResourceTest extends TestCase
{

    /**
     * @var ZipResource
     */
    private $zipResource;

    protected function setUp(): void
    {
        parent::setUp();
        $zipModel = $this->prophesize(Zip::class);
        $zipModel
            ->addMethodProphecy(
                (new MethodProphecy(
                    $zipModel,
                    'getAttribute',
                    ['zip']
                ))->willReturn(123)
            );
        $zipModel
            ->addMethodProphecy(
                (new MethodProphecy(
                    $zipModel,
                    'getAttribute',
                    ['city']
                ))->willReturn('Test City')
            );

        $this->zipResource = new ZipResource($zipModel->reveal());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->zipResource = null;
    }

    public function testToArray()
    {
        $this->assertEquals(
            [
                'zip' => '00123',
	            'city' => 'Test City',
            ],
            $this->zipResource->toArray(null)
        );
    }
}
