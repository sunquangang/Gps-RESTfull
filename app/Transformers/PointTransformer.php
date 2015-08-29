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

      //dd($resource);
        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'description' => $resource->description,
            'coordinats' => [
                'longitude' => $resource->longitude,
                'latitude' => $resource->latitude,
                'coordinates' => $resource->coordinates
            ],
            //'header_image' => $resource->image[0]->path .'/'. $resource->id .'/'. $resource->image[0]->filename.'.'.$resource->image[0]->mime,
            'images' => $resource->image,
            'created_by' => $resource->user,
            'tag' => [
              $this->loop_tags($resource->tags)
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

    /**
    * Transform a collection of Tags
    * @return array $array An array of tags
    */
    private function loop_tags($tags){
      //return($tags);
      $array = [];
      foreach ($tags as $key => $tag) {
        $array[$key] = [
          'id' => $tag->id,
          'tag' => $tag->name,
          'meta' => [
            "links" => [
                "rel" => "self",
                "slug" => $tag->id,
                "uri" => "/api/tag/". $tag->id
            ],
            "created_at" => $tag->created_at
          ]
        ];
      }
      return $array;
    }


}
