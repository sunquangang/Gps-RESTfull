<?php

namespace App\Transformers;

use League\Fractal;
use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class TagsWithPointTransformer extends TransformerAbstract
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
    protected $defaultIncludes = ['points'];

    /**
     * Transform object into a generic array
     * @var  object
     */

    public function transform($resource)
    {


        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'points' => [
              //$resource->points, 'user' => $resource->point],
              $this->includePoints($resource->points)
            ],
            'meta' => [
                'created_at' => $resource->created_at,
                'last_update' => $resource->updated_at,
                'links' => [
                    'rel' => 'self',
                    'slug' => $resource->id,
                    'uri' => 'api/tags/'.$resource->id,
                ]
            ]
        ];
    }

    public function includePoints($points)
      {
        //dd($points);
        //dd($this->defaultIncludes);
          $point = $points;

          return $this->item($point, new PointTransformer);
      }

}
