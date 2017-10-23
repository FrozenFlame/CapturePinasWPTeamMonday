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


$query = $_POST['query'];
?>
<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <script src="js/navbar.js"></script>
    <script src= "post/postfactory.js"> </script>
    <link href="css/home-in.css" rel="stylesheet">
    <link href="css/post.css" rel="stylesheet">
      <link href="css/navbar.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Nav bar -->
    <?php 
    if($isGuest == FALSE)
        include 'nav-bar.php';
    else
        include 'nav-bar-guest.php';
    ?>
    <!-- End of Nav bar -->
    <br/>
    <br/>
    <h1 id ="h1-search">Results for: ""</h1>

    <p id="line-bold"></p>
    <!-- this is where results will be generated -->
    
    <div id="result-posts" style="padding-bottom:30px;padding-left:30px;padding-right:30px;"> 
    <h2 id = "searchby"></h2>
    </div>

    <script>
        var isGuest = "<?php echo $isGuest ?>";
        function goToMyProfile(elem)
        {
            if(!isGuest)
            {
            var form = document.createElement('form');  
            form.method = 'post';
            form.action = 'user-profile.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'userid';
            input.value = 
            "<?php  if($isGuest == FALSE)
                        echo $_SESSION['id'];
                    else 
                        echo 0;
            ?>";
            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
            }
        }
        $(document).ready(function(){ 
            if($('#searchby').val()==''){
                $('#searchby').hide();
            }
        });
        var off = 0;
        var mode = "searchPlace";
        window.onload = doSet();
        function doSet() //actually prepares navbar is what set does, and for this page, this also initiates search population
        {
            if(!isGuest)
            {
                var passed = 'getId';
                $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
                {                                                               //data there is what php will return or "echo"
                    $('a#nav_name_user').text(data+' ');
                    $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
                });
            }
            var searchby;
            switch(mode)
            {
                case 'searchPlace': searchby = "place"; break;
            }
            // post population
            
            var search = "<?php echo $query; ?>";
            document.getElementById("h1-search").innerHTML = "Results for: \"" +search +"\"";
            $.post('ajax/db_dealer.php', {type:"search", command:mode, searchplace: search, offset: 0}, function(data)
            {
                if(data)
                {
                    createPostLite(document.getElementById('result-posts'), data, 0);
                }
                else 
                    document.getElementById('result-posts').innerHTML = "<h2> No posts found with your search query. :(<h2/> <br/> <h2>Sorry! -Team Monday </h2>";
            });
        }

      
          
        </script>   
    </body>
</html>