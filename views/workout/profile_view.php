<? include('includes.php');
   

?>
 <link rel="stylesheet" type="text/css" href="http://garvinling.com/profile_view.css"/>




<link href="http://garvinling.com/bootstrap/css/bootstrap-tagsinput.css" rel="stylesheet" type="text/css">
<script src="http://garvinling.com/js/bootstrap-tagsinput.js" type="text/javascript" charset="utf-8"></script>




<script>


</script>

</head>

<body>
		<div id="header_bar">
			<div class="row">

				<div class="col-md-2" style="">

					<h1>SimplyFit</h1>

				</div>

				<div class="col-md-2" style="width:700px; margin-top:10px;">
					<ul id="top_menu_wrapper">
						<li id="top_menu"><a href="#">Workouts</a></li>
						<li id="top_menu"><a href="#">Schedule</a></li>
						<li id="top_menu"><a href="#">Add Exercise</a></li>
						<li id="top_menu"><a href="../workoutlogger/logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>


		<div id="side_thang">
		
		<div class="row">
			<div class="col-md-12">
				<div class="circle-text" style="margin-left:auto; margin-right:auto;"><div><h1 id="code_indicator">C</h1></div></div>
			</div>
		</div>
		<br><br>

		<div class="row">
			<div class="col-md-12" style="">
				<div class="btn-group" style="margin-left:55px; margin-right:auto; ">
				  <button type="button" class="btn btn-default" style="width:65px;"><span class="glyphicon glyphicon-stats"></span></button>
				  <button type="button" class="btn btn-default" style="width:65px;"><span class="glyphicon glyphicon-list"></span></button>
				  <button type="button" class="btn btn-default" style="width:65px;"><span class="glyphicon glyphicon-cog"></span></button>
				</div>
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-md-12">

				<ul id="tag_selector">
					<?   /*
							circle-text-HIIT
							circle-text-cross
							circle-text-strength
							circle-text
						 */ 
					?>
					<li><div class="circle-text-HIIT" style="width:50px;"><div><h1 id="code_indicator" style="font-size:20px;">H</h1></div></div></li>
					<br>
					<li><div class="circle-text-cross" style="width:50px;"><div><h1 id="code_indicator" style="font-size:20px;">X</h1></div></div></li>
					<br>
					<li><div class="circle-text-strength" style="width:50px;"><div><h1 id="code_indicator" style="font-size:20px;">S</h1></div></div></li>
					<br>
					<li><div class="circle-text" style="width:50px;"><div><h1 id="code_indicator" style="font-size:20px;">C</h1></div></div></li>


				</ul>




			</div>
		</div>





	</div><!--end side thang-->






		<div id="dat_main_content_doe" style="color:black;">
		
			<div id="workout_item_list">
		<!--		  <div id="workout_item">
					
					<div class="row">
						
							<div class="col-md-2"id="item_date">

								<h2 id="date_month">Jan</h2>
								<h1 id="date_day">21</h1>
							</div>

							<div class="col-md-4"id="item_time_highlights">

								<h4 id="workout_time">Elapsed time: 23:09</h4>
								<h4 id="workout_highlights_reps">Best reps: <span id="highlight_text">12</span></h4>
								<h4 id="workout_highlights_weight">Best weight: <span id="highlight_text">130 lbs.</span></h4>
							</div>

							<div class="col-md-4"id="item_workout_tags">

								<a href="#"><code>Leg day</code></a>
								<a href="#"><code>quads</code></a>
								<a href="#"><code>hamstrings</code></a>
								<a href="#"><code>calves</code></a>
								<a href="#"><code>squatcity</code></a>
								<a href="#"><code>neverskiplegday</code></a>


							</div>

						
							<div class="col-md-2"id="item_workout_tags">

								<div class="circle-text-strength" style="width:70px; margin-top:-13px; margin-left:12px;"><div><h3 id="code_indicator">S</h3></div></div>


						</div>
					</div>
				</div><End workout item -->

				<?
				if(isset($_SESSION['workout_items']))
				{
					
					echo "<a href=\"\" id=\"workout_item_click\"  data-toggle=\"modal\" data-target=\"#workoutItemModal\">";
					for($i = 0 ; $i < sizeof($_SESSION['workout_items']); $i = $i + 1)
					{

							
							for($j = 0;    $j < 15; $j = $j + 1)
							{

									echo $_SESSION['workout_items'][$i][$j];

							}
					}

					echo "</a>";
				}

				?>



				<div class="row">
					<div class="col-md-2">

							<button class="btn btn-primary" style="width:65px;" data-toggle="modal" data-target="#workoutModal" id="new_log_button"><span class="glyphicon glyphicon-plus-sign"></span></button>

					</div>
				</div>
	


			</div>


<div class="modal fade" id="workoutItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div align="center"><h4 class="modal-title" id="myModalLabel" style="font-family:'Source Sans Pro', sans-serif; font-weight:700;">Add a Friend</h4></div>
      </div>
      <div class="modal-body">
          <div class="register-form" align="center">

          <h1 id="register_title">Details</h1>
          <br><br>


              <form id="login_form">
               
               <div class="form-group">
                <input type="text" name="existing_user_name" placeholder="Enter Username" class="form-control" id="existing_user_name"/>
               </div>

              <div class="form-group">
                <input type="password" name="existing_pw" placeholder="Password" class="form-control" id="existing_pw"/>
              </div>

               <input type="submit" class = "btn btn-primary btn-large input-block-level" id="login_button" value="Login"/>
              </form>
        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!--end of main content --> 




<!-- Modal -->
<div class="modal fade" id="workoutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog" style="width:1000px;">
    <div class="modal-content" style="border-radius:0px;">
      <div class="modal-body">
          <div class="register-form">
	          
	          <h1 id="register_title">Record a workout</h1>
	          <br><br>
				
	          	<h2>Choose an existing workout:</h2>
				<select class="form-control" id="existing_workouts">


					<? if(isset($_SESSION['routine_names']))
					{
						for($i = 0; $i < sizeof($_SESSION['routine_names']); $i = $i + 1)
						{
	           				echo "<option value=\"".$_SESSION['routine_names'][$i]."\">".$_SESSION['routine_names'][$i]."</option>";



						}

					}
					?>



				</select>
				<br><br>
				<button id="create_new" class="btn btn-primary">Create New Routine</button>
				<br><br>

				<div id="existing_workout" style="display:none;">
				<!-- specify the number of exercises user wishes to add -->
	          	<h2>Create a new workout routine: </h2>

	          		<? // be able to post routines and grab routines from others  GENERATE DYNAMICALLY FROM SERVER.  ?>
	              <form class="form-inline" id="exercise_create_form">
	              	
	              	<div class="form-group" id="exercise_form_group">
	               	<label for="exercise">How many exercises?</label>
	                <input type="text" name="number_of_exercises" placeholder="(Enter # of exercises in this routine.)" class="form-control" id="number_of_exercises"/><br><br>
	                </div>
	              
	               <br>

		           <div class="form-group">
				   <label for="exercise">Name your exercise:</label>
				   <input type="text" name="routine_name" placeholder="(Ex. Tricep Thursday)" class="form-control" id="routine_name"/>
				   </div> 
				   
				   <br><br>
			       
			       <div class="form-group">
			       <label for="tags">Enter tags:</label><br>
			       <input type="text" data-role="tagsinput" id="tags" name="tags" class="form-control" placeholder="Separate tags by space"/>
			       </div>
			       
			       <br><br>

	                <input type="submit" class = "btn btn-success btn-large input-block-level" id="exercise_add_button" value="Create"/>
	              
	               <br><br>

	           </form>


	           <!--<button id="test_button">TESTER</button>-->



		
	           <div id="exercise_form">
						

				 <input type="submit" class = "btn btn-success btn-large input-block-level" id="create_workout_button" value="Creatsse" style="display:none;"/>
	              </form>
        </div> <!-- end form-div -->
 </div>





    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->







<!-- jQuery/JavaScript Libraries --> 
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://garvinling.com/bootstrap/js/bootstrap.js"></script>

</body>

</html>