<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Results extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
			
		session_start();
		date_default_timezone_set('America/Los_Angeles');
		parent::__construct();

	}



	public function index()
	{		

			if(!isset($_SESSION['items'])){

			}
			else{
				

			}
			$this->load->library('simple_html_dom');
			$this->load->helper('form');
			$this->load->helper('url');

			
			$this->load->view('recipe_results');



	}

	



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */