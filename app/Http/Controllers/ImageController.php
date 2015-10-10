<?php namespace App\Http\Controllers;

use App\Image;
use App\Transformers;
use Auth;
use File;
use Fractal;
use Illuminate\Http\Request;
use Input;
use Storage;

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
            if (!$request->hasFile('photo')) {
                return $this->respondWithError('No photo is selected');
            }
            $file = $request->file('photo');
            // Create Eloquent object
            $image = new Image();
            $image->point_id = $request->id;
            $image->filename = $this->generate_random_string();
            $image->mime_type = $file->getClientMimeType();
            $image->base_64 = $this->convert_to_base_64($file);
            $image->created_by = Auth::user()->id;
            $image->updated_by = Auth::user()->id;


            if (!$image->save()) {
                // If creation fails
                // Return error response
                return $this->respondInternalError();
            }
            // Select latest row from DB
            $resp = $image->orderBy('id', 'DESC')->first();
            // return with Fractal
            return Fractal::item($resp, new \App\Transformers\ImageTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
    }

    /**
     * Generate a random string based on microtime
     * @return string
     */
    private function generate_random_string()
    {
        $enc = md5(uniqid('', true));
        //dump($enc);
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
        //$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return base64_encode($data);
    }

}
