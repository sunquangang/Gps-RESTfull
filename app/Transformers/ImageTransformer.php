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
        //return new \League\Fractal\Resource\Collection($resource,new ResourceTransformer);

        return [
            'id' => $resource->id,
            'filename' => $resource->filename,
            'base_64' => $resource->base64,
            'mime_type' => $resource->mime_type,
            'path' => $resource->path
        ];
    }

}
