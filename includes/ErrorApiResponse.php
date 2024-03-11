<?php

class ErrorApiResponse
{
    private int $status;
    private string $code;
    private string $message;

    private array $response;

    public function __construct(int $status, string $code, string $message)
    {
        $this->status = $status;
        $this->code = $code;
        $this->message = $message;
        $this->response = ['code' => $code, 'message' => $message];
    }

    public static function newResponse(string $message)
    {
        $response = new ErrorApiResponse(500, '10000', $message);
        return json_encode($response->response);
    }

    public function getResponse(): string
    {
        return json_encode($this->response);
    }
    public function getStatus(): int
    {
        return $this->status;
    }

}

// move above to here
enum ErrorResponse
{
    case bad_request = new ErrorApiResponse(400, '10000', 'bad_request');
    case unauthorized = new ErrorApiResponse(491, '10001', 'unauthorized');
    case page_not_found = new ErrorApiResponse(404, '10002', 'page_not_found');
    case internal_server_error = new ErrorApiResponse(500, '10003', 'internal_server_error');
    case failed_to_connect = new ErrorApiResponse(500, '10004', 'failed_to_connect');

    public static function getErrorResponse(string $message)
    {
        return ErrorApiResponse::newResponse($message);
    }
    public function getStatus(): int
    {
        return $this->value->getStatus();
    }
    public function getResponse(): string
    {
        return $this->value->getResponse();
    }
}

?>