<?php

use PHPUnit\Framework\TestCase;

class ResponseTeste extends TestCase
{
    public function testOk()
    {
        $response = request('ok');
        $this->assertEquals(200, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('ok.json'),
            $response['body']
        );
    }

    public function testCreated()
    {
        $response = request('created');
        $this->assertEquals(201, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('created.json'),
            $response['body']
        );
    }

    public function testBadRequest()
    {
        $response = request('badrequest');
        $this->assertEquals(400, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('badrequest.json'),
            $response['body']
        );
    }

    public function testUnauthorized()
    {
        $response = request('unauthorized');
        $this->assertEquals(401, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('unauthorized.json'),
            $response['body']
        );
    }

    public function testForbidden()
    {
        $response = request('forbidden');
        $this->assertEquals(403, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('forbidden.json'),
            $response['body']
        );
    }

    public function testNotFound()
    {
        $response = request('notfound');
        $this->assertEquals(404, $response['statusCode']);
        $this->assertJsonStringEqualsJsonFile(
            getJsonPath('notfound.json'),
            $response['body']
        );
    }
}
