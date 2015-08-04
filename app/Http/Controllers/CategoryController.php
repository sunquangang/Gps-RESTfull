<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;
use Cron\Tests\AbstractFieldTest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        try
        {
            $categories = Category::with('point')->get();
            if ($categories) {
                return \Response::json([
                    'data' => $this->_transformCollection($categories->toArray())
                ], 200);
            } else {
                return $this->_fail_404();
            }
        }
        catch (Exception $e)
        {
            return $this->_fail_501();
        }
    }

    /**
     *   Transform a collection of gps-points
     * @param array $points
     * @return array [arr] An array of the transformed points
     */
    private function _transformCollection(array $points)
    {
        return array_map([$this, '_transformItem'], $points);
    }

    /**
    * 404 fail!
    * @return json Response with JSON status 404
    */
    private function _fail_404()
    {
        return \Response::json([
                    'error' => 'Collection not found',
                    'status' => 404
            ], 404);
    }

    /**
    * 501 fail!
    * @return json Response with JSON status 501
    */
    private function _fail_501()
    {
        return \Response::json([
                'error' => 'Something did not work as expected.',
                'status' => '501',
            ], 501);
    }

    /**
     *  Display a single gps-point with category
     *  @var int Id or the Point
     *  @return json Response with JSON data
     *  @
     *
     *
     */
    public function show($id)
    {
        try
        {
            $categories = Category::where('id', $id)->with('point')->first();
            if ($categories) {
                return \Response::json([
                    'data' => $this->_transformItem($categories->toArray())
                ], 200);
            } else {
                return $this->_fail_404();
            }
        }
        catch (Exception $e)
        {
            return $this->_fail_501();
        }
    }

    /**
     * Transform a single listing of the resource.
     * @param array An array with one item
     * @return array Transformed Category Response
     */
    private function _transformItem($item)
    {
        return [
            'id' => (int) $item['id'],
            'category' => $item['name'],
            'point' => $item['point']
        ];
    }



}
