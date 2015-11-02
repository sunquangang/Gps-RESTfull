<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class PointLikeTransformer extends TransformerAbstract
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
        //return [$resource];
        //return new \League\Fractal\Resource\Collection($resource,new ResourceTransformer);
        return [
        'likes' => $resource->likes,
        'point_id' => $resource->point_id
        ];
    }


}
