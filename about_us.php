<!-- Team Monday -->
<?php
session_start();
$isGuest;
if(!isset($_SESSION['id'])) # if user is a guest.
{
//   header('Location: index.php');
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
      <h1> Meet the Team Monday Crew </h1>

      
     </div>
   
   </body>

</html>