<?php namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests\StoreCategoryRequest;
use Fractal;
use App\Category;
use App\Transformers;
use Illuminate\Validation\Validator;
use Mockery\CountValidator\Exception;


/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends ApiController
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return $this->all();
    }

    /**
     * @return mixed
     */
    public function all()
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

    /**
     * @return mixed
     */
    public function create()
    {
        return \View::make('categories.create');
    }

    /**
     * @param Request $request
     * @return string
     */
    public  function store(Request $request){


        try {
            //return $request->name;
            $validator = \Validator::make($request->all(), [
                'name' => 'required|unique:categories|min:3'
            ]);


            if ($validator->fails()) {
                return $this->respondWithError($validator->errors());
            }

            $category = new Category;
            $category->name = $request->get('name');
            if (!$category->save()){
                return $this->respondWithError('Could not create category');
            }
            return Fractal::item($category, new \App\Transformers\CategoryTransformer)->responseJson(200);


            //return redirect('/categories');


        } catch(Exception $e) {
            return $this->respondInternalError();
        }

    
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
