<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json extends CI_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function OK()
	{
		$this->load->view('welcome_message');
	}

	public function CREATED()
	{
		$this->load->view('welcome_message');
	}

}
