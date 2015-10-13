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
    protected $defaultIncludes = ['created_by', 'tags', 'images'];

    /**
     * Transform object into a generic array
     *
     * @var  object
     * @return array
     */
    public function transform($point)
    {
        return [
            'id' => $point->id,
            'name' => $point->name,
            'description' => $point->description,
            'coordinats' => [
                'country' => $point->country,
                'longitude' => $point->longitude,
                'latitude' => $point->latitude
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
                'created_at' => $point->created_at
            ]
        ];
    }

    /**
     * @param $point
     * @return Collection
     */
    public function includeTags($point)
    {
        $tags = $point->tags;
        return $this->collection($tags, new TagTransformer);
    }


    /**
     * @param $point
     * @return Collection
     */
    public function includeImages($point)
    {
        $image = $point->image;
        return $this->collection($image, new ImageTransformer);
    }

    /**
     * @param $point
     * @return Item
     */
    public function includeCreatedBy($point)
    {
        $user = $point->user;
        return $this->item($user, new UserTransformer);
    }




}
