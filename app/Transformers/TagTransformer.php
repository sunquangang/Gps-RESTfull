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
class TagTransformer extends TransformerAbstract
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
    protected $defaultIncludes = ['created_by'];


    /**
     * Transform object into a generic array
     *
     * @var  object
     */
    public function transform($resource)
    {
        return [
            'id' => $resource->id,
            'tag' => $resource->tag,
            'meta' => [
                'links' => [
                    'rel' => 'self',
                    'slug' => $resource->id,
                    'uri' => 'api/tags/'.$resource->id,
                ],
            ]
        ];
    }


    public function includeCreatedBy($point)
    {
        $user = $point->user;
        return $this->item($user, new UserTransformer);
    }

}
