<?php

class Template {
	protected $_ci;

	function __construct() {
		$this->_ci = &get_instance(); //Untuk Memanggil function load, dll dari CI. ex: $this->load, $this->model, dll
	}

	public function admin($template = NULL, $data = NULL)
	{
		if ($template != NULL) {
			// head
			$data['_meta']			= $this->_ci->load->view('admin/layouts/_meta', $data, TRUE);
			$data['_css'] 			= $this->_ci->load->view('admin/layouts/_css', $data, TRUE);
			
			// navbar
			$data['_navbar'] 			= $this->_ci->load->view('admin/layouts/_navbar', $data, TRUE);
			
			//Sidebar
			$data['_sidebar'] 		= $this->_ci->load->view('admin/layouts/_sidebar', $data, TRUE);
			
			//Content
			$data['_content'] 		= $this->_ci->load->view($template, $data, TRUE);
			
			//Footer
			$data['_footer'] 		= $this->_ci->load->view('admin/layouts/_footer', $data, TRUE);
			
			//JS
			$data['_js'] 			= $this->_ci->load->view('admin/layouts/_js', $data, TRUE);

			echo $data['template'] = $this->_ci->load->view('admin/layouts/master', $data, TRUE);
		}
	}

	public function owner($template = NULL, $data = NULL)
	{
		if ($template != NULL) {
			// head
			$data['_meta']			= $this->_ci->load->view('owner/layouts/_meta', $data, TRUE);
			$data['_css'] 			= $this->_ci->load->view('owner/layouts/_css', $data, TRUE);
			
			// navbar
			$data['_navbar'] 			= $this->_ci->load->view('owner/layouts/_navbar', $data, TRUE);
			
			//Sidebar
			$data['_sidebar'] 		= $this->_ci->load->view('owner/layouts/_sidebar', $data, TRUE);
			
			//Content
			$data['_content'] 		= $this->_ci->load->view($template, $data, TRUE);
			
			//Footer
			$data['_footer'] 		= $this->_ci->load->view('owner/layouts/_footer', $data, TRUE);
			
			//JS
			$data['_js'] 			= $this->_ci->load->view('owner/layouts/_js', $data, TRUE);

			echo $data['template'] = $this->_ci->load->view('owner/layouts/master', $data, TRUE);
		}
	}

	public function driver($template = NULL, $data = NULL)
	{
		if ($template != NULL) {
			// head
			$data['_meta']			= $this->_ci->load->view('driver/layouts/_meta', $data, TRUE);
			$data['_css'] 			= $this->_ci->load->view('driver/layouts/_css', $data, TRUE);
			
			// navbar
			$data['_navbar'] 			= $this->_ci->load->view('driver/layouts/_navbar', $data, TRUE);
			
			//Sidebar
			$data['_sidebar'] 		= $this->_ci->load->view('driver/layouts/_sidebar', $data, TRUE);
			
			//Content
			$data['_content'] 		= $this->_ci->load->view($template, $data, TRUE);
			
			//Footer
			$data['_footer'] 		= $this->_ci->load->view('driver/layouts/_footer', $data, TRUE);
			
			//JS
			$data['_js'] 			= $this->_ci->load->view('driver/layouts/_js', $data, TRUE);

			echo $data['template'] = $this->_ci->load->view('driver/layouts/master', $data, TRUE);
		}
	}

	public function home($template = NULL, $data = NULL)
	{
		if($template != NULL) {
			// head
			$data['_meta']			= $this->_ci->load->view('layouts/_meta', $data, TRUE);
			$data['_css'] 			= $this->_ci->load->view('layouts/_css', $data, TRUE);
			
			// navbar
			$data['_navbar'] 			= $this->_ci->load->view('layouts/_navbar', $data, TRUE);
			
			//Content
			$data['_content'] 		= $this->_ci->load->view($template, $data, TRUE);
			
			//Footer
			$data['_footer'] 		= $this->_ci->load->view('layouts/_footer', $data, TRUE);
			
			//JS
			$data['_js'] 			= $this->_ci->load->view('layouts/_js', $data, TRUE);

			echo $data['template'] = $this->_ci->load->view('layouts/master', $data, TRUE);
		}
	}
}
