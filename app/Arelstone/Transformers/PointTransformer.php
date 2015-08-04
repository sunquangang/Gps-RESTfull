<?php namespace Arelstone\Transformers;

/**
 * Class PointTransformer
 * @package Arelstone\Transformers
 */
class PointTransformer extends Transformer {



    /**
     * Display a listing of the resource.
     * @method private
     * @return Response
     */


    public function transformItem(array $point)
    {
        //return $point['category'];
        return [
            'id' => (int) $point['id'],
            'coordinates' => [
                'longitude' => $point['longitude'],
                'latitude' => $point['latitude']
            ],
            'category' => $point['category'],
            'image' => $point['image'],
            'created_by' => $point['user'],
            'meta' => [
                'created_at' => Date($point['created_at']),
                'last_update' => Date($point['updated_at']),
                'links'   => [
                    'rel' => 'self',
                    'uri' => '/api/points/'.$point['id'],
                ],
                'status_code' => $this->getStatusCode(),
            ]
        ];
    }


}