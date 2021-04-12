<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Templates extends CI_Controller {

	/**
	 * How to use view template in controller?
	 *
	 * 
	 * Title segment
	 * 
	 * Title segment is your website title, by default this library generate
	 * title based on segment 1 and subtitle based on segment 2
	 * 
	 * 		http://example.com/index.php/<title>/<subtitle>
	 * 
	 * But you can custom generate title and subtitle based on segment 2 and 3
	 * using code below:
	 * 		
	 * 		$this->template->title_segment(2, 3);
	 * 
	 *	- or you can custom generate title only based on segment 2
	 *
	 * 		$this->template->title_segment(2);
	 * 
	 * 	- or you can custom generate subtitle only based on segment 3
	 *
	 * 		$this->template->title_segment(NULL, 3);
	 * 
	 * ------------------------------------------------------------------------
	 * 
	 * Layout
	 * 
	 * Layout is directory of all your part template, example: app, css, 
	 * or script. By default the directory points to application/views/layouts. 
	 * But you can custom your layout directory, if you want points to 
	 * 'application/views/your_layouts' you can use code below:
	 * 
	 * 		$this->template->layout('your_layouts');
	 * 
	 * ------------------------------------------------------------------------
	 * 
	 * Main layout
	 * 
	 * File name of main template by default is 'app.php'
	 * inside directory 'application/views/layouts'.
	 * But you can custom your main layout, if you want points to
	 * 'application/views/your_layouts/your_app.php' you can use code below:
	 * 
	 * 		$this->template->app('your_app');
	 * 
	 * ------------------------------------------------------------------------
	 * 
	 * Stack
	 * 
	 * If you have a css or script for specific page, you can push part of 
	 * layout by code below in your controller:
	 * 
	 *		$this->template->push('_your_css', 'css');
	 * 
	 * first parameter is your layout part directory, then second parameter 
	 * is your stack name. You can call a function inside your main layout 
	 * 'application/views/layouts/app.php' like this:
	 * 
	 * 		<?= $this->template->stack('css') ?>
	 * 
	 * @link https://github.com/davidchoir/codeigniter-view-template
	 */
	public function __construct()
    {
        parent::__construct();
        // $this->template->title_segment(2, 3);
        // $this->template->layout('second_layouts');
        // $this->template->app('second_app');
    }

	public function index()
	{
		// Title pege will be generated automatically by template library
		// based on URI Class Codeigniter Framework
		// 
		// But you can overwrite title and subtitle page by using code below
		
		$data['title']		= 'Welcome to Codeigniter View Template';
		$data['subtitle']	= 'example';

		$this->template->view('welcome', $data);
	}

	public function stack()
	{
		$this->template->push('stack/_css', 'css');
		$this->template->push('stack/_script', 'script');

		$this->template->view('stack/index');
	}
}
