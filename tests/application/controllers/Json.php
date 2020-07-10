<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

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

}
