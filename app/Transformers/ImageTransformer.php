<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ImageTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var  array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include
     *
     * @var  array
     */
    protected $defaultIncludes = [];

    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform($resource)
    {
        return [
            'filename' => $resource->filename,
            'mime_type' => $resource->mime_type,
            'data' => 'data:'.$resource->mime_type.';base64,'.$resource->base64, //$resource->base64,
            'raw' => $resource->base64,
        ];
    }

}
