<?php namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests\StoreCategoryRequest;
use Fractal;
use App\Category;
use App\Transformers;
use Illuminate\Validation\Validator;


/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
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
            $categories = Category::all();
            if (!$categories) {
                return $this->respondNotFound();
            }
            return Fractal::collection($categories, new \App\Transformers\CategoryTransformer)->responseJson(200);
        }
        catch (Exception $e)
        {
            return $this->respondWithError();
        }
    }


    public  function store(StoreCategoryRequest $request){

        $category = new Category;
        $category->name = \Input::get('name');

        return $category;
    }

    /**
     *  Display a single category
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
            $category = Category::where('id', $id)
                ->first();
            if ($category) {
                return Fractal::item($category, new \App\Transformers\CategoryTransformer)->responseJson(200);
            } else {
                return $this->respondNotFound();
            }
        }
        catch (Exception $e)
        {
            return $this->respondWithError();
        }
    }




}
