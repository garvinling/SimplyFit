<?php 

	class Workout_log_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		public function createNewLog($username,$date_month,$date_day,$routine_name,$weight,$reps,$tags,$type){

					$comma_separated_repetitions = implode(",", $reps);
					$comma_separated_weight = implode(",", $weight);
					
	

					//Account fo ryear! 
					$data_logs = array(

							'id_username' => $username,
							'date_month'        => $date_month,
							'date_day'        =>   $date_day,
							'name_of_routine' => $routine_name,
							'weight'      => $comma_separated_weight,
							'repetitions' => $comma_separated_repetitions,
							'tags'        => $tags,
							'type'        => $type
								

							);

							$this-> db -> insert('user_workouts_logs', $data_logs);

		}




		/**
		* Function: gatherLogs()
		* Param: $username the id_username to query
		* Get all workout log objects from the db where id_username(db_column) == $username
		*/
		public function gatherLogs($username){

			$q = $this -> db -> where('id_username',$username)->limit(10)->get('user_workouts_logs');	//Limit 10 for now.

			if($q->num_rows > 0)
			{
				return $q ->result_array();
			}

		}


		/**
		* Function: getLastMatchingWorkoutObject($routine_name)
		* Param: $routine_name 
		* Get all matching logs with matching routine
		*/
		public function getLastMatchingWorkoutObject($username,$routine_name){

			$matching_logs = array();
			$routine_name = strtolower($routine_name);
			$q = $this -> db -> where('id_username',$username)->where('name_of_routine',$routine_name)->get('user_workouts_logs');

			if($q -> num_rows > 0)
			{
				return $q -> result_array();
			}

			return false;
		}


		/**
		* Function: getTypes($username)
		* Param: $username
		* Get all types with username given
		*/
		public function getTypes($username)
		{

			$q = $this -> db -> where('id_username',$username) -> get('user_workouts_logs');

			if($q -> num_rows > 0)
			{
				return $q -> result_array();
			}

			return false;


		}















	}
