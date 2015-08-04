<?php  namespace App\Http\Controllers;

class ApiController extends Controller {
	protected $statusCode = 200;

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}



	public function respondNotFound($message = 'Not found!')
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}

	public function respondInternalError($message = 'Internal Error!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}

	public function respondBadRequest($message = 'Bad Request!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}

	public function respondForbidden($message = 'Forbidden!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}
	public function respondUnauthorized($message = 'Unauthorized! Please login!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}


	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
		
	}

	public function respond($data, $headers = [])
	{
		return \Response::json($data, $this->getStatusCode(), $headers);
	}
}