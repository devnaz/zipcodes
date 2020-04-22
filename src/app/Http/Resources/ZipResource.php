<?php

namespace App\Http\Resources;

use App\Models\Zip;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Presentation of data information.
 */
class ZipResource extends JsonResource
{

    public function __construct(Zip $zipModel)
    {
        parent::__construct($zipModel);
        self::withoutWrapping();
    }

    public function toArray($request)
    {
        return [
            'zip' => str_pad($this->getAttribute('zip'), 5, 0, STR_PAD_LEFT),
            'city' => $this->getAttribute('city'),
        ];
    }
}
