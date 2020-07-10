<?php

namespace Sescmg\CiCore;

class CiOutput extends \CI_Output
{
    protected const HTTP_OK = 200;
    protected const HTTP_CREATED = 201;

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
}
