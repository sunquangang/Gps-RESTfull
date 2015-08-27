<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class CategoryWithPointTransformer extends TransformerAbstract
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
     * @var  object
     */

    public function transform($resource)
    {


        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'points' => [$resource->point, 'user' => $resource->point],
            //'points' => $this->_transformPoint($resource->point),
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

    /**
     * @todo Brug PointTransformer
     *
     *
     * @param $resource
     * @return mixed
     */
    private function _transformPoint($resource)
    {

        /*foreach ($resource as $res) {
            var_dump($res->all());
        }*/




        //dd(\Fractal::collection($resource, new PointTransformer));
        return \Fractal::collection($resource, new PointTransformer);
    }

}
