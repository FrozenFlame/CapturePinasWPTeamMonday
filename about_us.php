<!-- Team Monday -->
<?php
session_start();
$isGuest = TRUE;
if(!isset($_SESSION['id'])) # if user is a guest.
{
    $isGuest = TRUE;
}
else
    $isGuest = FALSE;

?>
<html>
   <head>
      <title>CapturePinas</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
      <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
      <script src="js/jquery-3.2.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="post/postfactory.js"> </script>
      <link href="css/about-us.css" rel="stylesheet">
      <link href="css/home-in.css" rel="stylesheet">
      
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
         <script src="js/html5shiv.js"></script>
         <script src="js/respond.min.js"></script>
      <![endif]-->
      <style>
      body
      {
          background-image: url('\\CapturePinasWPTeamMonday\\images\\assets\\cropped-neu.jpg');
      }
      </style>
      
   </head>     
   
   <body>

    <?php 
    if($isGuest == FALSE)
        include 'nav-bar.php';
    else
        include 'nav-bar-guest.php';
    ?>
    <br/>
     <div class="container">
      <h1 id ="header-text"><b> Meet the Team Monday Crew </b></h1>
      <br>
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-offset-1 col-lg-2" id="div1">
                <img src="images/assets/TheCrew/jarvis.png">
                <h3>Reymark Arsenio</h3>
                <p>Say what you want here guys</p>
              </div>    
              
              <div class="col-sm-6 col-md-3 col-lg-2">
                <img src="images/assets/TheCrew/cat.png">
                <h3>Celine Yu Catalan</h3>
                <p>Say what you want here guys</p>
              </div>
              
              <div class="col-sm-6 col-md-3 col-lg-2">
                <img src="images/assets/TheCrew/greek.png">
                <h3>Greg Marvin Adversario</h3>
                <p>Say what you want here guys</p>
              </div>
              
              <div class="col-sm-6 col-md-3 col-lg-2">
                <img src="images/assets/TheCrew/kyuzee.png">
                <h3>Joshua Cabangon</h3>
                <p>Say what you want here guys</p>
              </div>
            <div class="col-sm-6 col-md-3 col-lg-2">
            <img src="images/assets/TheCrew/DD_.png">
            <h3>Denzel Marcu Deogracias</h3>
            <p>Say what you want here guys</p>
            </div>
        </div>
      
     </div>
   
   </body>

</html>