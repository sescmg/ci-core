<?php

namespace Sescmg\CiCore;

class CiOutput extends \CI_Output
{
    public const HTTP_OK = 200;
    public const HTTP_CREATED = 201;

    public const HTTP_BAD_REQUEST = 400;
    public const HTTP_UNAUTHORIZED = 401;
    public const HTTP_FORBIDDEN = 403;


    /**
     * Send json respose to browser and exit
     *
     * @param array $content
     * @param integer $code
     * @return void
     */
    public function responseJson(array $content, int $code): void
    {
        $this->set_content_type('application/json')
        ->set_status_header($code)
        ->set_output(json_encode($content))
        ->_display();
        exit;
    }

    /**
     * Create response array
     *
     * @param mixed $data
     * @param string $message
     * @param array $details
     * @param string $code
     * @return void
     */
    protected function createResponse($data, string $message = null, array $details = [], string $code = null)
    {
        $response = [];
        
        $response['data'] = $data;

        if (is_string($message) && !empty($message)) {
            $response['message'] = $message;
        }

        if (!empty($details)) {
            $response['details'] = $details;
        }

        if (is_string($code) && !empty($code)) {
            $response['code'] = $code;
        }

        return $response;
    }

    /**
     * Send response with status 200
     *
     * @param mixed $data
     * @param string $message
     * @return void
     */
    public function jsonOk($data, string $message = null): void
    {
        $this->responseJson(
            $this->createResponse($data, $message),
            $this::HTTP_OK
        );
    }

    /**
     * Send response with status 201
     *
     * @param mixed $data
     * @param string $message
     * @return void
     */
    public function jsonCreated($data, string $message = null): void
    {
        $this->responseJson(
            $this->createResponse($data, $message),
            $this::HTTP_CREATED
        );
    }

    /**
     * Send response with status 400
     *
     * @param mixed $data
     * @param array $details
     * @param string $message
     * @param string $code
     * @return void
     */
    public function jsonBadRequest($data, array $details, string $message = null, string $code = null): void
    {
        $this->responseJson(
            $this->createResponse($data, $message, $details, $code),
            $this::HTTP_BAD_REQUEST
        );
    }

    /**
     * Send response with status 401
     *
     * @param string $message
     * @param string $code
     * @return void
     */
    public function jsonUnauthorized(string $message = null, string $code = 'Unauthorized'): void
    {
        $this->responseJson(
            $this->createResponse(null, $message, [], $code),
            $this::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Send response with status 400 and form validation errors
     *
     * @param string $message
     * @return void
     */
    public function jsonFormValidationError(string $message = null)
    {
        $ci =& get_instance();
        $errors = $ci->form_validation->error_array();
        $this->jsonBadRequest(
            null,
            $this->prepareErrorArray($errors),
            $message,
            'validationError'
        );
    }


    /**
     * Modify error array
     *
     * @param array $errors
     * @return array
     */
    protected function prepareErrorArray(array $errors): array
    {
        return array_map(
            function ($key, $value) {
                return [
                    'target' => $key,
                    'message' => $value
                ];
            },
            array_keys($errors),
            array_values($errors)
        );
    }
}
