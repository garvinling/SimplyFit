<?php


require(APPPATH.'libraries/REST_Controller.php');

	class SimplyFitAPI extends REST_Controller{


			function index(){

				$this->config->set_item('csrf_protection',FALSE); //Temporarily set this to true for testing purposes. 

				echo "You do not have access to this page.";


			}


			/*

				Get/Authenticate user based on username/password

			*/
			function user_get(){

				//How to call: garvinling.com/SimplyFitAPI/user/id/gling/pw/password/format/json
				
				$this->load->model('user_model');
				
				if(!$this->get('id') || !$this->get('pw')){

					$this->response('Invalid Parameters',401);

				}

				$user = $this->user_model->loginUser($this->get('id'),$this->get('pw'));
				
				if($user)
				{
					$this->response($user,200);		//Return the user and success code
				}
				else
				{
					$this->response('Not Found',401);		//Return nothing and error code not authorized
				}

			}

/*


			function user_post(){

				//Warning: csrf_protection is set to FALSE for testing.  We need to figure what to do with this.  
				//This is just for the purposes of testing because the POST request is not coming from a form.  
				//How to call: scure.me/index.php/scure_api/user/
				//Send post request in body 
				//email_username,email_domain,pw,firstname,lastname

				$this->load->model('user_model');

				$email          = html_entity_decode($this->input->post('email'));
				$pw = $this->input->post('pw');
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
					
				$error_param = json_encode(array('status'=>'Invalid Parameters'));
				$error_not_found   = json_encode(array('status'=>'User not found'));
				$success_add       = json_encode(array('status'=>'User Added'));

			

			}*/

/*
			function user_put(){
				
				$email = $this->put('email');
				$pw = $this->put('pw');
				$firstname = $this->put('firstname');
				$lastname = $this->put('lastname');

				$this->load->model('user_model');
				if(!$email || !$pw || !$firstname || !$lastname){

					$this -> response(array('status'=>'Invalid parameters'),400);

				}

				$user_data = array(

								'email' => $email,
								'pw'    => $pw,
								'firstname' => $firstname,
								'lastname' => $lastname
								  
								  );


				$user = $this->user_model->put($user_data);

				if($user){

					$this->response(array('Status'=>'OK'),200);
				
				}
				else{


					$this->response(array('Status'=>'Already Exists',400));


				}


			}
*/



}


?>