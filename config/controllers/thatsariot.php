<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Thatsariot extends CI_Controller {

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
		

		$api_key = "?api_key=0d97b6fc-f4dd-4ab1-8c4d-747a3f8ba5b4";
		$this->load->helper('form');
		$this->load->helper('url');

		$this->load->view('riot_view');
	


	}

	public function getinfo(){
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('summoner', 'summoner id', 'required');


		if($this->form_validation->run() !== false)
		{

			$summoner_name = $this->input->post('summoner');
			$_SESSION['summoner_name'] = $summoner_name;
			$api_key = "?api_key=0d97b6fc-f4dd-4ab1-8c4d-747a3f8ba5b4";
			$url = 	"http://prod.api.pvp.net/api/lol/na/v1.1/summoner/by-name/".$summoner_name.$api_key;
			$result = $this->sendCurl($url);



			//GET SUMMONER LEVEL
			if($result !== false){

				$_SESSION['summoner_level'] = $result["summonerLevel"];
				$_SESSION['summoner_id'] = $result["id"];
				$id = $_SESSION['summoner_id'];
				$json_result = $this->getRecentGames($id);

				$lastChampId = $json_result["games"][0]["championId"];
				$lastChampUsed = $this->getLastChampName($lastChampId);

				$_SESSION['lastchamp'] = $lastChampUsed;


/**e
				if(isset($_SESSION["championsarray"])){	
						
							echo "locally."
						$json_result = $_SESSION["championsarray"];

						for($i=0;$i<sizeof($json_result["champions"]);$i=$i+1){

									$champID = $json_result["champions"][$i]["id"];
										if($champID === $id){
											$_SESSION['lastchamp'] = $json_result["champions"][$i]["name"];

										}


								}

				}
				else{
					echo "api hit.";
				$lastChampUsed = $this->getLastChampName($lastChampId);
				$_SESSION['lastchamp'] = $lastChampUsed;

				}**/

			}
	
			//return summonerLevel
			$this->load->view('riot_view');
		}
		redirect('thatsariot');
	}

	private function sendCurl($url){


			$curl = curl_init();   			
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_TIMEOUT_MS,1000);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			//inform cURL that were returning the result to a variable.  
			$result = curl_exec($curl);

			if($result !== false){
						
						$result = json_decode($result,true);

						curl_close($curl);
						return $result;
			}
			else{
				return false;
			}



	}


	private function getRecentGames($id){

		$result = array();
		$url = "https://prod.api.pvp.net/api/lol/na/v1.1/game/by-summoner/".$id."/recent?api_key=0d97b6fc-f4dd-4ab1-8c4d-747a3f8ba5b4";
			
			$curl = curl_init();   			
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_TIMEOUT_MS,1000);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			//inform cURL that were returning the result to a variable.  
			$result = curl_exec($curl);
			$json_result = json_decode($result,true);

			$lastChampionID = $json_result["games"][0]["championId"];
			


			return $json_result;

	}


	private function getLastChampName($id){

		$url = "https://prod.api.pvp.net/api/lol/na/v1.1/champion?freeToPlay=false&api_key=0d97b6fc-f4dd-4ab1-8c4d-747a3f8ba5b4";
			$curl = curl_init();   			
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_TIMEOUT_MS,1000);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			//inform cURL that were returning the result to a variable.  
			$result = curl_exec($curl);
			$json_result = json_decode($result,true);
			

      if(isset($json_result["champions"])){

			for($i=0;$i<sizeof($json_result["champions"]);$i=$i+1){

				$champID = $json_result["champions"][$i]["id"];
					if($champID === $id){
						$_SESSION['championarray'] = $json_result;
						return $json_result["champions"][$i]["name"];

					}


			}
		}
		else{

			if($json_result["status"]["message"]=="Rate limit exceeded"){
				$_SESSION['limit'] = true;

				return false;
			}
		}
			return false;


	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */