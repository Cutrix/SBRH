<?php

class Labs extends CI_Controller {

	public function index() {

	}
	public function config()
	{
		$this->config->load('auth');
		echo $this->config->item('MIN_PWD_LENGTH');
	}
}
