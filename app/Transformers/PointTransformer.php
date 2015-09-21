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
    public function transform($point)
    {
//$header_img = $point->image->first();
//dd($header_img);
      //return $point;
        return [
            'id' => $point->id,
            'name' => $point->name,
            'description' => $point->description,
            'coordinats' => [
                'longitude' => $point->longitude,
                'latitude' => $point->latitude
            ],
            'created_by' => $point->user,
            'images' => $this->loop_images($point->image),
            'tag' => [
              $this->loop_tags($point->tags)
            ],
            'meta' => [
                'status' => [
                    'message' => 'Ay Okay. Found!',
                    'status_code' => 200
                ],
                'links'   => [
                    'rel' => 'self',
                    'uri' => '/api/points/'.$point->id,
                ],
                'created_at' => $point->created_at,
            ]
        ];
    }

    /**
    * Transform a collection of Tags
    * @return array $array An array of tags
    */
    private function loop_tags($tags){
        $array = [];
        foreach ($tags as $key => $tag) {
            $array[$key] = [
                'id' => $tag->id,
                'tag' => $tag->name,
                'meta' => [
                    "links" => [
                        "rel" => "self",
                        "slug" => $tag->id,
                        "uri" => "/api/tags/". $tag->id
                    ],
                    "created_at" => $tag->created_at
                ]
            ];
        }
        return $array;
    }

    private function loop_images($images){
        $array = [];
        foreach ($images as $key => $image) {
            $array[$key] = [
                'filename' => $image->filename,
                'extension' => $image->ext,
                'path'=> $image->path . '/' . $image->filename.'.'.$image->ext,
                'meta' => [
                    "links" => [
                        "rel" => "self",
                        "uri" => "/api/point/". $image->point_id . '/images/' . $image->filename
                    ],
                    "created_at" => $image->created_at
                ]
            ];
        }
        return $array;
    }



}
