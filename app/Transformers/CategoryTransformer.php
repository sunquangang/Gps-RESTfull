<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class CategoryTransformer
 * @package App\Transformers
 */
class CategoryTransformer extends TransformerAbstract
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
            'name' => $resource->name,
            'meta' => [
                'created_at' => $resource->created_at,
                'last_update' => $resource->updated_at,
                'links' => [
                    'rel' => 'self',
                    'slug' => $resource->id,
                    'uri' => 'api/categories/'.$resource->id,
                ]
            ]
        ];
    }

}
