<!-- Team Monday -->
<?php
session_start();

if(!isset($_SESSION['id'])) # if user is already logged in, redirect to logged in page.
{
  header('Location: index.php');
} 



?>
<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/home-in.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Nav bar -->
    <div class="container">
    <div class="col-lg-6" id="mydiv">
	<b id="word">fake</b>
        <div class="input-group my-group"> 

            <input type="text" class="form-control" name="snpid" placeholder="Test"/>
            <select id="lunch" class="selectpicker form-control" data-live-search="true" title="Please select a lunch ...">
                <option>Hot Dog, Fries and a Soda</option>
                <option>Burger, Shake and a Smile</option>
                <option>Sugar, Spice and all things nice</option>
                <option>Baby Back Ribs</option>
                <option>A really really long option made to illustrate an issue with the live search in an inline form</option>
            </select> 
            <span class="input-group-btn">
                <button class="btn btn-default my-group-button" type="submit" id="btn" onclick="change()">GO!</button>
            </span>
        </div>
    </div>
<div>
<script type="text/javascript">
function change()
{
   $('b#word').text('yeah');
    var int = 0;
    var toAppend = '<b id="post'+a+'"yeah</b>';
    $('div#mydiv').append(toAppend);
    int++;
}
</script>
    <!-- End of Nav bar -->
      
      
      
      <script>
        window.onload = doSet();
        
           function doSet()
          {
              var passed = 'getId';
              
                 
                  $('a#nav_name_user').text(data+' ');
              $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
                  
              });        
          }
       
          
          
        </script>
      
  </body>
</html>