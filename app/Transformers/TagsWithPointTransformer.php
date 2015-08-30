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

    public function transform($tag)
    {
//return $resource;

        return [
            'id' => $tag->id,
            'name' => $tag->name,
            'points' => [
              //$resource->points, 'user' => $resource->point],
              $this->includePoints($tag->points)
            ],
            'meta' => [
                'created_at' => $tag->created_at,
                'last_update' => $tag->updated_at,
                'links' => [
                    'rel' => 'self',
                    'slug' => $tag->id,
                    'uri' => 'api/tags/'.$tag->id,
                ]
            ]
        ];
    }

    public function includePoints($points)
      {
        //dd($points);
        //dd($this->defaultIncludes);
          $point = $points;
          //var_dump($point);
        foreach ($point as $p) {
          //var_dump($p->get());
          return $this->item($p, new PointTransformer);
        }

      }

}
