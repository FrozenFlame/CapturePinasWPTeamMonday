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
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src= "post/postfactory.js"> </script>
    <link href="css/home-in.css" rel="stylesheet">
    <link href="css/post.css" rel="stylesheet">
      <!--fake-->
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
    <br/>
    
    <?php 
    $postID = (isset($_GET['post']) && !empty($_GET['post'])) ? $_GET['post'] : 0;
    // $postID = $_POST['post'];
    include("post/post.php"); ?>
      

    <script>
        $(document).ready(function(){ 
            $("#dropdown-button").click(function(){
                $("#places-dropdown").slideToggle();
            });
              $('#places-dropdown').on('click',function(e)
                   {
                        $('#topic').val($(e.target).text());
                        //$('#topic').Text($(e.target).text());
                        $('#places-form').submit();
                   });
        });
        window.onload = doSet();
        var isGuest= "<?php echo $isGuest; ?>"; 
       // var isGuest = (item > 0) ? item : 1;//this isGuest stuff is for when the person viewing a particular post is logged in or not, this will urge them to log in if they try to do likes/comment etc related
        var counter;
        
        function doSet() //actually prepares navbar is what set does
        {
            var passed = 'getId';
            
            $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
            {                                                               //data there is what php will return or "echo"
                $('a#nav_name_user').text(data+' ');
                $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
            });
         
        }

        // $("button#navbar-search-button").click(function()
        // {
        //     //this is the basic search function, not advanced search
        //     //Plaintext could mean either place or title text, likely to be place text
        //     //@ means user search ex: @Reymark
        //     var navSearchText = $("input#navbar-search").val();
        //     var command = "search";
        //     window.location = "search_results.php";
        // });
        
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
                // $.post('user_profile.php', {userid: elem.dataset.userid});
            }
        }
    </script>      
  </body>
</html>
