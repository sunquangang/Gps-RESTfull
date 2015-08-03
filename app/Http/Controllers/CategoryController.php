<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
            return $this->_fail_505();
        }
    }

    public function show($id)
    {
        try
        {
            $categories = Category::find($id)->with('point')->get();
            if ($categories) {
                return $categories;
                return \Response::json([
                    'data' => $this->_transformItem($categories->toArray())
                ], 200);
            } else {
                return $this->_fail_404();
            }
        }
        catch (Exception $e)
        {
            return $this->_fail_505();
        }
    }

  

    private function transformWithPoint($data)
    {
        return $data;
    }

    private function _transformCollection(array $items)
    {
        return array_map([$this, 'transformItem'], $items);
    }

    /**
     * Display a listing of the resource.
     * @method private
     * @return Response
     */
    private function _transformItem($item){
        return [
            'id' => (int) $item['id'],
            'category' => $item['name']
        ];
    }
    private function _fail_404(){
        return \Response::json([
                    'error' => 'Collection not found', 
                    'status' => 404
            ], 404);
    }
    private function _fail_505() {
        return \Response::json([
                'error' => 'Something did not work as expected.',
                'status' => '501',
            ], 501);
    }



}
