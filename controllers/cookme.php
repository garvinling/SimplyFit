<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cookme extends CI_Controller {

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

			
			$this->load->view('recipe_view');



	}

	private function sendCurl($url){


			$curl = curl_init();   			
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_TIMEOUT_MS,1000);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			//inform cURL that were returning the result to a variable.  
			$result = curl_exec($curl);
			curl_close($curl);

			if($result !== false){
						
						//$result = json_decode($result,true);

						return $result;
			}
			else{
				return false;
			}



	}

	public function getDirections($html){

			$directions = $html->find('div[itemprop=recipeInstructions]');
			$p_tags = array();
			$i = 0;
			foreach($html->find('div[itemprop=recipeInstructions]') as $divRecipe) 	//find every <p> tag within <div> with itemProp=reci...
			{
			       foreach($divRecipe->find('p') as $p) 
			       {
			             // do something...
			       	$p_tags[$i] = $p;
			       	$i = $i + 1;

			       }
			}

			$directions_string = implode(",",$p_tags);
			$_SESSION['directions'] = $directions_string;

	}

	public function getRecipe(){

			$this->load->library('simple_html_dom');
			$this->load->helper('form');
			$this->load->helper('url');
			$page = $this->input->post('pastelink');
			//Need to verify a valid foodnetwork url
		 	$html = new simple_html_dom();  
    		$html->load_file($page);  
    		$items = $html->find('li[itemprop=ingredients]');    
    		for($i=0;$i<sizeof($items);$i=$i+1){

    			//echo $items[$i]."<br>";

    		}
			$this->getDirections($html);
			$items_string = implode(",", $items);

			$_SESSION['items'] = $items_string;



			//$this->load->view('recipe_view');
			redirect('results');

	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */