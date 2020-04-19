<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Codeigniter view template library
 * 
 * @author David Choir
 * @link https://github.com/davidchoir/codeigniter-view-template
 * 
 */
class Template {

	/**
	 * Data for class manipulation
	 * 
	 * @var Array
	 */
	private $_var_section = array();

	/**
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * @param $var
	 * @return mixed
	 */
	public function __construct()
    {
        $this->CI =& get_instance();
	}

	/**
	 * Set of data array sections
	 *
	 * @param String $key
	 * @param String $value
	 * @return Array
	 */
	private function _set_section($key, $value)
	{
		$this->_var_section[$key] = $value;
	}

	/**
	 * Set the page title from URI segment
	 *
	 * @return String
	 */
	private function _get_title()
	{
		$segment_two = ucfirst($this->CI->uri->segment(2));
		$segment_two = ! empty($segment_two) ? ' - ' . $segment_two : NULL;

		return ucfirst($this->CI->uri->segment(1)) . $segment_two;
	}

	/**
	 * Get the layout part like css, script, navbar, header, footer etc
	 * 
	 * @param	String	$template	directory path template
	 * @return	Array
	 */
	private function _section($template)
	{
		$this->CI->load->helper('file');

		// get all files from view path
		$file_name = get_filenames(VIEWPATH . $template . '/');

		$partial_file = array();
		foreach ($file_name as $key => $value) {

			// set of data array sections
			// remove extension .php from section name
			$section_name = str_replace('.php', '', $value);
			if ($value[0] == '_') $partial_file[] = $this->_set_section($section_name, $this->CI->load->view($template . '/' . $value, NULL, TRUE));
		}
	}

	/**
	 * Render page view template
	 * 
	 * @param	String	$template	directory path template
	 * @param	String	$view		directory path view
	 * @param	Array	$vars		parse array data to view
	 * @param	Boolean	$return
	 * @return	mixed
	 */
	public function view($template, $view, $vars = array(), $return = FALSE)
	{
		$this->CI->load->library('parser');

		// set of data array sections for parsing into html
		if ( ! isset($vars['title'])) $this->_set_section('title', $this->_get_title());
		$this->_section($template);
		$this->_set_section('content', $this->CI->load->view($view, $vars, TRUE));

		// merge array from section and controller
		$data = array_merge($vars, $this->_var_section);

		// render page using template parsing
		$this->CI->parser->parse($template . '/app', $data, $return);
	}
}
