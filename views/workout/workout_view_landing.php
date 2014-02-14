
 <?include('includes.php');?>
  <link rel="stylesheet" type="text/css" href="http://garvinling.com/stylesheet_workout.css"/>

    </head>

<body>

<section id="top_section">


<h1 style="color:gray;">SimplyFit</h1>

</section>

 <section data-type="background" id="section_2_bg">
	<section id="section_2_overlay">
    <div class="row" id="section_2_content">



        <div class="col-md-12" id="hero_text_wrapper">
         
          <img src="linecons/512/calendar.png" style="height:75px;">

          <p style="padding:12px;">
         <h2 id="sub_title_top">Track your fitness.</h2> 
         <h3> A workout logger for everyone. Simple and free.</h3>  
         <br>
        
         <button class="btn btn-large btn-primary" type="button" data-toggle="modal"data-target="#friendModal">Log in
         <i class="icon-plus icon-white"></i></button>


         <a href="#"><button class="btn btn-warning" id="start_button" data-toggle="modal" data-target="#registerModal">Get Started</button></a>

          </p>

		    </div>
    </div><!--end fluid row -->
  </section>
</section>      
        

  <section data-type="background" id="section_about_bg">
  <section id="section_about_overlay">
        
    <div class="row" style="text-align:center;">
      <div class="col-md-12" style="text-align:center;">
        <h1 style="color:black; font-size:72px;">Fits your needs</h1><br><br>
       
            </div>
          </div>

    <div class="row" style="text-align:center;">
        
        <div class="col-md-4" style="text-align:center;">
        <h1 style="color:#f05253; font-size:30px;">Iron Junkie</h1>
        <p style="font-size:25px;">
          Keep track of reps/weight over time. 
          <br><br><img src="linecons/512/settings.png" style="height:70px;">
        </p>


        </div>

        <div class="col-md-4" style="text-align:center;">
        <h1 style="color:#ef7c52; font-size:30px;">Cardio</h1>
        <p style="font-size:25px;">
          Keep track of run distances and times.  
          <br><br><img src="linecons/512/fire.png" style="height:70px;">
        </p>

 
        </div>

        <div class="col-md-4" style="text-align:center;">
        <h1 style="color:#4dbfbf; font-size:30px;">Mixed</h1>
        <p style="font-size:25px;">
         Sort mixed data by tags.
          <br><br><img src="linecons/512/search.png" style="height:70px;">
        </p>
 
        </div>


          </div>

  </section>
</section> 





<section data-type="background" id="section_about_2_bg">
  <section id="section_about_2_overlay">
   

  </section>
</section> 




<!-- Modal -->
<div class="modal fade" id="friendModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div align="center"><h4 class="modal-title" id="myModalLabel" style="font-family:'Source Sans Pro', sans-serif; font-weight:700;">Add a Friend</h4></div>
      </div>
      <div class="modal-body">

          <div class="register-form" align="center">
          <?php echo form_open('welcome/addFriend');?>  

          <input type="text" name="friend_email" id="friend_email" placeholder="Search E-mail" maxlength="20"style=" display:block;width:300px;background-color:#F6F6F6;font-family: 'Noto Sans', sans-serif; font-weight:300; height:24px; font-size:18px; text-align:center;"/>
          <br>
          <input type="submit" class = "btn btn-danger btn-large  input-block-level" style="width:310px; background-color:#DF314D;" value="Add Friend" style=""/>

          <?php echo form_close(); ?>





        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  
<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content" style="border-radius:0px;">
      <!--<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div align="center">

          <h4 class="modal-title" id="myModalLabel"></h4></div>
      </div>-->
      <div class="modal-body">
          


          <div class="register-form" align="center">

          <h1 id="register_title">Register</h1>
          <br><br>


              <form id="register_form">
               
               <div class="form-group">
                <input type="text" name="user_name" placeholder="Enter Username" class="form-control" id="user_name_input">
               </div>

              <div class="form-group">
                <input type="password" name="pw_input" placeholder="Password" class="form-control" id="user_pw_input">
              </div>

               <input type="submit" class = "btn btn-success btn-large input-block-level" id="register_new_button"value="Register"/>


              </form>


        </div>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--
  <section data-type="background" id="section_3_bg">
              <a name="blog" id="blog"></a>
  <section id="section_3_overlay">

    <div class="container">
    <div class="row" id="section_3_content">
          

          <div class="col-md-4" style="border:1px solid:">
              <h3 id="sub_title_section3">Featured Calibration</h3>

              <div class="block_holder" style="margin-left:50px;">
                  <div class="hover_block block_5">
                      <img src="img/ttrs_calibration.jpg" width="250px" />
                      <div class="left_half"></div>
                      <div class="right_half"></div>
                      <div class="hover_info">
                          <h1>Stage 2 Software</h1>
                          <p id="content_text_3">GIAC's newest Stage 2 software measured power gains of 78 horsepower and 70 pound feet of torque at the wheels, making a 26% increase in power over a stock TT-RS. </p>
                          <br><br><a style="font-family:'Source Sans Pro',sans-serif;" href="#">Read more</a>
                      </div>
                  </div>
              </div>
            <?/** <div class="image">
              <img src="img/ttrs_calibration.jpg" alt="ttrs" width="" id="fade_image"/>
              <h2><span><span class='spacer'></span>TT-RS: Stage 2 Software</span></h2>
              </div>**/?>
        </div>


          <div class="col-md-4">
          <h3 id="sub_title_section3">S6 4.0 TT</h3>
           
            <div class="block_holder" style="margin-left:50px;">
            <div class="hover_block block_5">
                <img src="img/s6_giac.jpg" width="250px" />
                <div class="left_half"></div>
                <div class="right_half"></div>
                <div class="hover_info">
                    <h1>Audi S6 Stage 1 </h1>
                    <p id="content_text_3">GIAC S6 4.0 TT software nearing completion.</p>
                    <br><br><a style="font-family:'Source Sans Pro',sans-serif;" href="#">Read more</a>
                </div>
            </div>
        </div>
        
        </div>

          <div class="col-md-4">
          <h3 id="sub_title_section3">2.0T Extreme K04 Testing</h3>
            
            <div class="block_holder" style="margin-left:50px;">
            <div class="hover_block block_5">
                <img src="img/gti_giac.jpg" width="250px" />
                <div class="left_half"></div>
                <div class="right_half"></div>
                <div class="hover_info">
                    <h1>GTI Extreme File </h1>
                    <p id="content_text_3">GIAC GTI smashes on v8s </p>
                    <br><br><a style="font-family:'Source Sans Pro',sans-serif;" href="#">Read more</a>
                </div>
            </div>
        </div>
        </div>


    </div>
  </div>
  </section>
</section>  -->












<!-- jQuery/JavaScript Libraries --> 
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>


 </body>
 </html>