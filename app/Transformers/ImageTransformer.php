<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Item;

class ImageTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources to automatically include.
     *
     * @var array
     */
    protected $defaultIncludes = ['created_by'];

    /**
     * Transform object into a generic array.
     *
     * @var object
     */
    public function transform($resource)
    {
        return [
            'filename' => $resource->filename,
            'mime_type' => $resource->mime_type,
            //'raw' => $resource->base_64,
            'source' => 'data:image/'.$resource->mime_type.';base64,'.base64_encode($resource->base_64),
            'meta' => [
              'created_at' => $resource->created_at,
              'links' => [
                  'rel' => 'self',
                  'slug' => $resource->filename,
                  'uri' => 'api/images/'.$resource->filename,
              ],
            ],
        ];
    }

    public function includeCreatedBy($resource)
    {
        $user = $resource->user;
        return $this->item($user, new UserTransformer());
    }
}
