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


	/**
	 * @param string $message
	 * @return mixed
     */
	public function respondNotFound($message = 'Not found!')
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}


	/**
	 * @param string $message
	 * @return mixed
     */
	public function respondInternalError($message = 'Internal Error!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}


	/**
	 * @param string $message
	 * @return mixed
     */
	public function respondBadRequest($message = 'Bad Request!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}

		/**
	 * @param string $message
	 * @return mixed
     */
	public function respondForbidden($message = 'Forbidden!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}


	/**
	 * @param string $message
	 * @return mixed
     */
	public function respondUnauthorized($message = 'Unauthorized! Please login!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}


	/**
	 * @param $message
	 * @return mixed
     */
	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
				'status_code' => $this->getStatusCode()
			]
		]);
		
	}

	/**
	 * @param $data
	 * @param array $headers
	 * @return mixed
     */
	public function respond($data, $headers = [])
	{
		return \Response::json($data, $this->getStatusCode(), $headers);
	}
}