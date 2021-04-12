<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Codeigniter view template library
 * 
 * @author	David Choir
 * @link	https://github.com/davidchoir/codeigniter-view-template
 * @version	1.2.0
 * 
 */
class Template {
	
	/**
	 * Layout template path and app layout template
	 * Default layout directory path is application/views/layouts
	 * Default app file path is application/views/layouts/app.php
	 * 
	 * @var String
	 */
	private $_layout	= 'layouts';
	private $_app		= 'app';

	/**
	 * Title segment template
	 * Default segment for title is 1 and subtitle is 2
	 * 
	 * @var String
	 */
	private $_segment_title 	= 1;
	private $_segment_subtitle	= 2;
		
	/**
	 * Data for class manipulation
	 * 
	 * @var Array
	 */
	private $_var_section	= array();
	private $_push_layout	= array();

	/**
	 * Enables the use of CI super-global without having to define an extra variable.
	 */
	private $CI;
	
	public function __construct()
    {
        $this->CI =& get_instance();
	}

	/**
	 * Set of data array sections
	 *
	 * @param String $key
	 * @param String $value
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
		$title = ! empty($this->CI->uri->segment($this->_segment_title)) ? $this->CI->uri->segment($this->_segment_title) : NULL;
		return ucfirst(str_replace('-', ' ', str_replace('_', ' ', $title)));
	}

	/**
	 * Set the page subtitle from URI segment
	 *
	 * @return String
	 */
	private function _get_subtitle()
	{
		$subtitle = ! empty($this->CI->uri->segment($this->_segment_subtitle)) ? $this->CI->uri->segment($this->_segment_subtitle) : NULL;
		return ucfirst(str_replace('-', ' ', str_replace('_', ' ', $subtitle)));
	}

	/**
	 * Get the layout part like css, script, navbar, header, footer etc
	 * 
	 * @param	String	$template	directory path template
	 */
	private function _section($template)
	{
		$this->CI->load->helper('file');

		// get all files from view path
		$file_name = get_filenames(VIEWPATH . $template . '/');
		if( ! empty($file_name))
		{
			foreach ($file_name as $key => $value)
			{
				// set of data array sections
				// remove extension .php from section name
				$section_name = str_replace('.php', '', $value);
				if ($value[0] == '_') $this->_set_section($section_name, $this->CI->load->view($template . '/' . $value, NULL, TRUE));
			}
		}
	}

	/**
	 * Set segment URI for auto generate page title
	 * 
	 * @param	Integer	$segment_title		segment URI number
	 * @param	Integer	$segment_subtitle	segment URI number
	 */
	public function title_segment($segment_title = NULL, $segment_subtitle = NULL)
	{
		if( ! is_null($segment_title)) $this->_segment_title 		= $segment_title;
		if( ! is_null($segment_subtitle)) $this->_segment_subtitle	= $segment_subtitle;
	}

	/**
	 * Push data layout part for specified page
	 * 
	 * @param	String	$path 	path of layout part
	 * @param	String	$alias 	name of parameter stack function on app function
	 */
	public function push($path, $alias = NULL)
	{
		if(is_null($alias)) $alias	= $path;

		$this->_push_layout[$alias]	= $path;
	}

	/**
	 * Load part file of layout
	 * 
	 * @param	String	$var	variable from push
	 */
	public function stack($var)
	{
		$data = isset($this->_push_layout[$var]) ? $this->_push_layout[$var] : NULL;
		
		if( ! is_null($data))
		{
			return $this->CI->load->view($data, NULL, TRUE);
		}
	}

	/**
	 * Set template layout path
	 * 
	 * @param	String	$path 	layout path
	 */
	public function layout($path = NULL)
	{
		if( ! is_null($path)) $this->_layout = $path;
	}

	/**
	 * Set main template path
	 * 
	 * @param	String	$path	main template path
	 */
	public function app($path = NULL)
	{
		if( ! is_null($path)) $this->_app = $path;
	}

	/**
	 * Render page view template
	 * 
	 * @param	String	$view		directory path view
	 * @param	Array	$vars		parse array data to view
	 * @param	Boolean	$return
	 * @return	mixed
	 */
	public function view($view, $vars = array(), $return = FALSE)
	{
		// set of data array sections for parsing into html
		if ( ! isset($vars['title'])) $this->_set_section('title', $this->_get_title());
		if ( ! isset($vars['subtitle'])) $this->_set_section('subtitle', $this->_get_subtitle());
		$this->_section($this->_layout);
		$this->_set_section('content', $this->CI->load->view($view, $vars, TRUE));

		// merge array from section and controller
		$data = array_merge($vars, $this->_var_section);

		$this->CI->load->view($this->_layout . '/' . $this->_app, $data, $return);
	}
}
