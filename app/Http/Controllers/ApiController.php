<?php  namespace App\Http\Controllers;


/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller {

	/**
	 * Set default status code
	 * @var int default 200
     */
	protected $statusCode = 200;

	/**
	 * Get Status Code
	 * Get the status code
	 *
	 * @return int $this->statusCode
     */
	public function getStatusCode()
	{
		return $this->statusCode;
	}

	/**
	 * Set status code
	 * @param $statusCode
	 * @return $this;
     */
	public function setStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		return $this;
	}

	/**
	 * Responde with Bad Request
	 * Send response with message and set status code to 501
	 *
	 * @param string $message
	 * @return mixed
     */
	public function respondBadRequest($message = 'Bad Request!')
	{
		return $this->setStatusCode(400)->respondWithError($message);
	}

	/**
	 * Responde with Request Unauthorized
	 * Send response with message and set status code to 401
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondUnauthorized($message = 'Unauthorized! Please login!')
	{
		return $this->setStatusCode(401)->respondWithError($message);
	}

	/**
	 * Responde with Request Forbidden
	 * Send response with message and set status code to 403
	 *
	 * @param string $message
	 * @return mixed
     */
	public function respondForbidden($message = 'Forbidden!')
	{
		return $this->setStatusCode(403)->respondWithError($message);
	}

	/**
	 * Responde with Not Found
	 * Send response with message and set status code to 404
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondNotFound($message = 'Not found!')
	{
		return $this->setStatusCode(404)->respondWithError($message);
	}


	/**
	 * Responde with Internal Error
	 * Send response with message and set status code to 500
	 *
	 * @param string $message
	 * @return mixed
	 */
	public function respondInternalError($message = 'Internal Error!')
	{
		return $this->setStatusCode(500)->respondWithError($message);
	}





	/**
	 * Responde with With error
	 * Send response with message and set status code to 500
	 *
	 * @param $message
	 * @return mixed
     */
	public function respondWithError($message)
	{
		return $this->respond([
			'error' => [
				'message' => $message,
			]
		]);

	}

	/**
	 * Send response as JSON
	 *
	 * @param $data
	 * @param array $headers
	 * @return mixed JSON object with data, status code and headers
     */
	public function respond($data, $headers = [])
	{



		return \Response::json($data, $this->getStatusCode(), $headers);
	}
}
