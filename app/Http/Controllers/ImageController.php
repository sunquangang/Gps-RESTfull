<?php namespace App\Http\Controllers;

use App\Image;
use Auth;
use Fractal;
use Illuminate\Http\Request;
use Input;
use Storage;
use \App\Transformers;
use File;

/**
 * Class ImageController
 * Handled upload of a image and converting it to base_64 format
 *
 * @package App\Http\Controllers
 * @author Carsten Daurehøj <arelstone@gmail.com>
 * @license  MIT
 * @version  0.1.0
 */
class ImageController extends ApiController
{

    /**
     * Show a image based on on the filename
     * @param $filename
     * @return mixed
     */
    public function show($filename)
    {
        $file = Image::where('filename', $filename)->firstOrFail();
        if (!$file) {
            return $this->respondWithError();
        }
        return Fractal::item($file, new \App\Transformers\ImageTransformer())->responseJson(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        try {
            $file = $request->file('photo');
            dump($request->all());
            // Make the validation rules
            $rules = [
                'photo' => 'required|image'
            ];
            // Validate $input with the validation $rules
            $validator = \Validator::make([$file], $rules);
            if ($validator->fails()) {
                // If validation fails
                // Return error response
                return $this->respondWithError($validator->errors());
            }
            // Create Eloquent object
            $image = new Image();
            if (!$image->create($input)) {
                // If creation fails
                // Return error response
                return $this->respondInternalError();
            }
            // Select latest row from DB
            $resp = $image->orderBy('id', 'DESC')->first();
            // return with Fractal
            return Fractal::item($resp, new ImageTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
    }

    /**
     * Generate a random string based on the user that is logged in and microtime
     * @return string
     */
    private function generate_random_string()
    {
        $enc = md5(uniqid($this->user()->id, true));
        return $enc;
    }


    /**
     * Convert the uploaded image to base_64
     * @param $image
     * @return string
     */
    private function convert_to_base_64($image)
    {
        $type = pathinfo($image, PATHINFO_EXTENSION);
        $data = file_get_contents($image);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

}
