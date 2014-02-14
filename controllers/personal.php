<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends CI_Controller {

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
			$this->load->library('simple_html_dom');
			$this->load->helper('form');
			$this->load->helper('url');
			$this->getRecentPosts();
			$this->load->view('personal_minimal');



	}

	

	public function getRecentPosts(){

		/**		$this->load->library('simple_html_dom');
				$page = "http://garvinling.wordpress.com";
			 	$html = new simple_html_dom();  
	    		$html->load_file($page);  
	    		$items = $html->find('h2[class=entry-title]'); 
	    		
	    		$i = 0; 

				foreach($html->find('h2[class=entry-title]') as $blogTitles) 	//find every <p> tag within <div> with itemProp=reci...
				{
				       foreach($blogTitles->find('a') as $a) 
				       {
				             // do something...
				       	$a_tags[$i] = $a;
				       	$i = $i + 1;

				       }
				}


				$_SESSION['recent_posts_links'] = $a_tags;
				$_SESSION['recent_posts_titles'] = $items;**/

		}


	public function contact(){



		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');


		$this->form_validation->set_rules('user_name', 'Name', 'required');
		$this->form_validation->set_rules('user_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('user_comments', 'Description', 'required');

		if($this->form_validation->run() !== false){
				
				$name = $this->input->post('user_name');
				$email= $this->input->post('user_email');
				$body= $this->input->post('user_comments');
				$_SESSION['name'] = $name;

				
				$body = $name." says: ".$body;
				$to = "garvin.ling@gmail.com";
				$emailSubject = "Garvinling.com Inquiry";
				$headers = "From:".$email."\r\n";
				$headers .= "Content-type: text/html\r\n";


				$success = mail($to, $emailSubject, $body, $headers);
			$this->load->view('email_confirm_view');
		}
		else{

			//Need a form validation solution.
			redirect('personal');
		}

	}






















}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */