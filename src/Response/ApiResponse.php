<?php


namespace App\Response;


use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    public function __construct(string $message, $data = null, array $errors = [], int $status = 200, array $headers = [], bool $json = false)
    {
        parent::__construct($this->format($message, $data, $errors), $status, $headers, $json);
    }

    /**
     * Format the API response.
     *
     * @param string $message
     * @param mixed  $data
     * @param array  $errors
     *
     * @return array
     */
    private function format(string $message, $data = null, array $errors = [])
    {
        if ($data === null) {
            $data = new \ArrayObject();
        }

        $response = [
            'message' => $message,
            'data'    => $data,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return $response;
    }
}