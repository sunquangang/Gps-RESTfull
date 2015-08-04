<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

/**
 * Class PointTransformer
 * @package App\Transformers
 */
class PointTransformer extends TransformerAbstract
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
     * @return array
     */
    public function transform($resource)
    {

        return [
            'id' => $resource->id,
            'coordinats' => [
                'longitude'=>$resource->longitude,
                'latitude'=>$resource->latitude,
            ],
            //'image' => $resource->image,
            'created_by' => $resource->user,

            'category' => [
                'id' => $resource->category->id,
                'name' => $resource->category->name,
                'links' => [
                    'rel' => 'self',
                    'uri' => '/api/categories/'.$resource->category->id
                ]
            ],
            'meta' => [
                'status' => [
                    'message' => 'Ay Okay. Found!',
                    'status_code' => 200
                ],
                'links'   => [
                    'rel' => 'self',
                    'uri' => '/api/points/'.$resource->id,
                ],
                'created_at' => $resource->created_at,

            ]
        ];
    }

}
