<?php

class Json extends CI_Controller
{

    public function index()
    {
        $this->ok();
    }

    public function ok()
    {
        $this->output->jsonOk([
            "foo" => 'bar'
        ], "message");
    }

    public function created()
    {
        $this->output->jsonCreated(null, "message");
    }

    public function badRequest()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data(['foo' => 'bar']);
        $this->form_validation->set_rules('foo', 'foo', 'required|integer');
        $this->form_validation->set_rules('bar', 'bar', 'required');
        $this->form_validation->run();
        $this->output->jsonFormValidationError('The form has errors!');
    }

    public function unauthorized()
    {
        $this->output->jsonUnauthorized("message unautorized");
    }

    public function forbidden()
    {
        $this->output->jsonForbidden("message forbidden");
    }

    public function notfound()
    {
        $this->output->jsonNotFound("message not found");
    }
}
