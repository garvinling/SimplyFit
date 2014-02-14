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

    <link rel="stylesheet" type="text/css" href="fonts.css">

    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="js/validate.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script' rel='stylesheet' type='text/css'>
 
    <link href='http://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Nobile:400,700' rel='stylesheet' type='text/css'>
    
    <script src="js/sticky/jquery.sticky.js"></script>
   
    <script>
    $('document').ready(function(){

        $('a').click(function(){
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 500);
            return false;
        });
        $("#sticker").sticky({topSpacing:0});
    });
    </script>
  
</head>

<html>
    <body>            


      <div style="margin-left:auto; margin-right:auto; margin-top:240px;">

        <h1 style="font-family: 'Signika Negative', sans-serif;">Thanks for the message, <?echo $_SESSION['name'].".";?></h1>
        <br><br>
        <p style="font-family: 'Signika Negative', sans-serif;">
        I will get back to you as quickly as possible! Thanks for your inquiry.
        </p>
        <br><br>
        <a href="http://garvinling.com" style="color:black;font-family: 'Signika Negative', sans-serif; text-decoration:none;">Go Back</a>



      </div> 

















       
        
    </body>
</html>