<?php 

	class Workout_routine_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		public function createNewRoutine($username,$routine_name,$exercises){



					$comma_separated_exercises = implode(",", $exercises);

					$routine = array(

							'id_username' => $username,
							'name_of_routine' => $routine_name,
							'exercises' => $comma_separated_exercises

							);

							$this-> db -> insert('user_workouts_routines', $routine);

		}


		public function getRoutines($username){




			$query = $this -> db -> where('id_username',$username)->get('user_workouts_routines');	//Should we set a limit here?



			if($query -> num_rows > 0)
			{

				return $query -> result_array(); 

			}


			return false;


		}



		/*
			Retrieves the workouts contained in the selected workout log. (Defined by log_id and username)
		*/	
		public function getRoutineWorkouts($id,$user){

				$nameOfRoutine="";

				$routineName_Query = $this -> db -> where('id_username',$user)->where('id_log',$id)->limit(1)->get('user_workouts_logs');

				if($routineName_Query -> num_rows > 0)
				{
					$nameOfRoutine = $routineName_Query -> row() -> name_of_routine;

				}


				$query = $this -> db -> where('id_username',$user)->where('name_of_routine',$nameOfRoutine)->limit(1)->get('user_workouts_routines');

				if($query -> num_rows > 0)
				{
					return $query -> row();
				}

				return false;


		}


		public function getNumOfExercises($routine_name){

			$query = $this-> db -> where('name_of_routine',$routine_name)->limit(1)->get('user_workouts_routines');

			if($query -> num_rows > 0)
			{
				return $query->row();
			}

			return false;

		}













	}
