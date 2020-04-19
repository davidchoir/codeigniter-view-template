<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {

	public function index()
	{
		$data = array();
		// Page title will be generated automatically by template library
		// except in default controller
		// But you can overwrite page title by using code below
		$data['title'] = 'Welcome to Codeigniter View Template';

		$this->template->view('layouts', 'welcome', $data);
	}
}
