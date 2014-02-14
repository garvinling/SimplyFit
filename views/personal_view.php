<!DOCTYPE>
<head>
  <link rel="icon" type="image/x-icon" href="http://garvinling.com/img/google-32-black.png">
  <link rel="shortcut icon" href="http://garvinling.com/img/google-32-black.png" type="image/x-icon" />

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="Flat-UI-master/css/flat-ui.css">
    <link rel="stylesheet" type="text/css" href="Flat-UI-master/css/demo.css">
    <link href='http://fonts.googleapis.com/css?family=Signika+Negative' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <link rel="stylesheet" type="text/css" href="stylesheet_2.css">


   <!-- <script src="bootstrap/js/bootstrap.js"></script>-->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
 
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Nobile:400,700' rel='stylesheet' type='text/css'>
   <!-- <script src="js/sticky/jquery.sticky.js"></script>-->
   
    <script>
    $('document').ready(function(){

        $('a').click(function(){
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 500);
            return false;
        });

        //$("#sticker").sticky({topSpacing:0});

        $('pull').click(function(){


        });
    });
    </script>



    
  

  
</head>

<html>
    <body>            
    
<nav class="clearfix">
    <ul class="clearfix">
        <li><a href="#home">GarvinLing</a></li>
        <li><a href="#about">About Me</a></li>
        <li><a href="#blog">Writing</a></li>
        <li><a href="#contact">Contact</a></li>
    </ul>
    <a href="#" id="pull">Menu</a>
</nav>  







<!-- Section #1 -->       
<section data-type="background" id="section_top_bg">
             <a name="home" id="home"></a>

	<section id="section_top_overlay">
    <div class="row-fluid" id="section_top_div"> 
        <div class="span12" id="header_section">
		  <h1 id="title">Garvin Ling</h1>
      <br><br>

      <div id ="personal_info_card">

        <img src="img/garvin.jpg" id="personal_image" class="img-circle" alt="garvin"/>
        <br><br>
        <div class = "row-fluid">
        <div class="span12"id="personal_info">

           Firmware Engineer @ Western Digital<br>
           Web Development Enthusiast<br>
           Long Beach, CA<br><br>
     
              <address>
              <a href="mailto:garvin.ling@gmail.com">garvin.ling@gmail.com</a><br>
              <abbr title="Phone">P:</abbr> (562) 500-5763
            </address>


        </div>
      </div>



        <div id="personal_links">
          <a target="_blank" href="http://github.com/garvinling"><img src="img/github-64-black.png" width="64px" alt="GitHub"/></a>
          <a target="_blank" href="http://www.linkedin.com/pub/garvin-ling/66/428/730"><img src="img/linkedin-64-black.png" width="64px" alt="LinkedIn"/></a>
          <a target="_blank" href="http://twitter.com/garvinling"><img src="img/twitter-64-black.png" width="64px" alt="Twitter"/></a>
          <a target="_blank" href="http://garvinling.wordpress.com"><img src="img/wordpress-64-black.png" width="64px" alt="WordPress"/></a>



          <?/**<img src="img/github.png" width="64px" alt="GitHub"/>
          <img src="img/linkedin.png" width="64px" alt="LinkedIn"/>
          <img src="img/twitter.png" width="64px" alt="LinkedIn"/>
          <img src="img/wordpress.png" width="64px" alt="WordPress"/>*/?>
        </div>
    
    </div>
		</div>
    </div>
	</section>
</section>
        
<?/***
<!-- Sticky Navigation --><!--
     <nav class="clearfix" id="sticker">  
        <ul class="clearfix">  
            <li><a href="#"></a></li>    
            <li><a href="#home">Me</a></li>  
            <li><a href="#about">About</a></li>  
             <li><a href="#blog">Articles</a></li>  
            <?//<li><a href="#portfolio">Work</a></li> ?> 
            <li><a href="#contact">Contact</a></li>  

            <li><a href="#"></a></li>    
        </ul>  
        <a href="#" id="pull">Menu</a>  
    </nav>      
-->**/?>
        
<!-- Section #2 -->
  <section data-type="background" id="section_2_bg">
        <a name="about" id="about"></a>

	<section id="section_2_overlay">
    <div class="row-fluid" id="section_2_content">

        <div class="span12" id="header_section" style="overflow:hidden;">
		      <h3 id="sub_title_top">Who am i? </h3>
          <p id="content_text">
          I'm a Firmware Engineer and a Web Development Enthusiast.  <br><br>
          I love tinkering with new web technologies and building random Arduino projects. <br><br>
          MicroControllers are awesome.  But MicroControllers + Web = more awesome.<br><br>
          I am <strong>available</strong> for freelance web and mobile design &amp; development.<br><br>  
          <a class="btn btn-danger btn-large" href="#contact">Interested?</a>  

              <br><br> 
          </p>
		</div>
        

    </div>
	</section>
</section>      
        
        

<!-- Section #3 -->
  <section data-type="background" id="section_3_bg">
              <a name="blog" id="blog"></a>

	<section id="section_3_overlay">
    <div class="row-fluid" id="section_3_content">
          <div class="span12">
          <h3 id="sub_title_section3">Recent Articles</h3>
          <p id="content_text_3">

          <?

            $items = $_SESSION['recent_posts_titles'];
            $items[0] = strip_tags($items[0]);
            $items[1] = strip_tags($items[1]);
            $items[2] = strip_tags($items[2]);

            $links = $_SESSION['recent_posts_links'];
            echo "<a style=\"font-size:34px; font-family: 'Signika Negative', sans-serif;\" href=\"".$links[0]->href."\"".">".$items[0]."</a><br>";
            echo "<a style=\"font-size:34px; font-family: 'Signika Negative', sans-serif;\" href=\"".$links[1]->href."\"".">".$items[1]."</a><br>";
            echo "<a style=\"font-size:34px; font-family: 'Signika Negative', sans-serif;\" href=\"".$links[2]->href."\"".">".$items[2]."</a><br>";


          ?>          





          </p>
        </div>
    </div>
	</section>
</section>            
      
  <?/***     
  <!-- Section #4 -->
  <section data-type="background" id="section_4_bg">
              <a name="portfolio" id="portfolio"></a>

	<section id="section_4_overlay">
    <div class="row-fluid" id="section_4_content">
          <h3 id="sub_title_top">Work.</h3>
          <br>
          <?include('portfolio_tiles.php');?> 
    
        </div>
	</section>
</section>  **/?>   
        
   <!-- Section #5 -->
  <section data-type="background" id="section_5_bg">
              <a name="contact" id="contact"></a>

	<section id="section_5_overlay">
    <div id="contact_form">        
          <h3 id="sub_title_contact">Contact Me.</h3><br>
            <? echo form_open('personal/contact');?>
         
	        	<input type="text" id="user_input" value="" name="user_name"  placeholder="Name" class="form-control" /><br><br>
	        	<input type="email" id="user_input" value="" name="user_email" placeholder="E-Mail (Required)" class="form-control" /><br><br>
            <textarea placeholder="Questions/Comments (Required)" name="user_comments"id="user_comments"></textarea><br><br>




                <input type="submit" id="user_submit" class="btn btn-danger" value="Send!" />
            <? echo form_close();?>
            <?php echo validation_errors(); ?>
 
    </div>
	</section>
</section>         
        
    </body>
</html>