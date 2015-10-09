<?php namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Input;
use Storage;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class ImageController
 * On upload images is converted to base64 and the submitted to the database table "images".
 *
 * @package App\Http\Controllers
 * @author Carsten Daurehøj <arelstone@gmail.com>
 * @license  MIT
 * @version  0.1.0
 */
class ImageController extends ApiController
{

    public function show($filename){
      $file = Image::where('filename', $filename)->firstOrFail();
      if (!$file) {
        return $this->respondWithError();
      }
      return \Fractal::item($file, new \App\Transformers\ImageTransformer())->responseJson(200);
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
          
            $original_file = Input::file('file');
            if (!$original_file) {
              return $this->respondWithError('No file is selected');
            }

            // Define the input
            $input = [
            'original_file' => $original_file,
            'point_id' => Input::get('point_id'),
            'created_by' => \Auth::user()->id,
            'updated_by' => \Auth::user()->id,
            'filename' => $this->generateRandomString(),
            'mime_type' => $original_file->getMimeType(),
            'base64' => $this->make_to_base_64($original_file)
          ];

          // Make the validation rules
          $rules = [
            'point_id' => 'required',
            'original_file' => 'required|image|mimes:jpeg,png,jpg,gif',
            'created_by' => 'required',
            'filename' => 'required'
          ];
            // Validate $input with the validation $rules
            $validator = \Validator::make($input, $rules);
            if ($validator->fails()) {
                // If validation fails
                // Return error response
                return $this->respondWithError($validator->errors());
            }
            // Create Elequent object
            $db = new Image();
            if (!$db->create($input)) {
                // If creation fails
                // Return error response
                return $this->respondInternalError();
            }
            // Select latest row from DB
            $resp = $db->orderBy('id', 'DESC')->first();
            // return with Fractal
            return \Fractal::item($resp, new \App\Transformers\ImageTransformer())->responseJson(200);
        } catch (Exception $e) {
            return $this->respondInternalError();
        }
    }

    /**
     * @return string
     */
    private function generateRandomString()
    {
        $enc = md5(uniqid(\Auth::user()->id, true));
        return $enc;
    }


    private function make_to_base_64($image){
      $type = pathinfo($image, PATHINFO_EXTENSION);
      $data = file_get_contents($image);
      $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      return base64_encode($base64);
    }

}
