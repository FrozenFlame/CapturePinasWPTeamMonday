<!-- Team Monday -->
<!-- NO DESIGN YET -->
<?php
session_start();
if(!isset($_SESSION['id'])) # if user is already logged in, redirect to logged in page.
{
  header('Location: index.php');
}

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
    <script src= "post/postfactory.js"> </script>
    <link href="css/home-in.css" rel="stylesheet">
    <link href="css/post.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Nav bar -->
    <?php 
    include 'nav-bar.php'; ?>
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
        function goToMyProfile(elem)
        {
            var form = document.createElement('form');  
            form.method = 'post';
            form.action = 'user-profile.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'userid';
            input.value = "<?php echo $_SESSION['id'] ?>";
            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
            // $.post('user_profile.php', {userid: elem.dataset.userid});
        }
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
            if($('#searchby').val()==''){
                $('#searchby').hide();
            }
        });
        var off = 0;
        var mode = "searchPlace";
        window.onload = doSet();
        function doSet() //actually prepares navbar is what set does, and for this page, this also initiates search population
        {
            var passed = 'getId';
            $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
            {                                                               //data there is what php will return or "echo"
                $('a#nav_name_user').text(data+' ');
                $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
            });
            var searchby;
            switch(mode)
            {
                case 'searchPlace': searchby = "place"; break;
            }
            // document.getElementById('searchby').innerHTML = "Searching by <i>" +searchby +"</i>";
            // post population
            
            var search = "<?php echo $query; ?>";
            document.getElementById("h1-search").innerHTML = "Results for: \"" +search +"\"";

            $.post('ajax/db_dealer.php', {type:"search", command:mode, searchplace: search, offset: 0}, function(data)
            {
                // alert(data);
                if(data)
                {
                    createPostLite(document.getElementById('result-posts'), data, 0);
                }
                else 
                    document.getElementById('result-posts').innerHTML = "<h2> No posts found with your search query. :(<h2/> <br/> <h2>Sorry! -Team Monday </h2>";
            });
        }

        // $("button#navbar-search-button").click(function()
        // {
        //     //this is the basic search function, not advanced search
        //     //Plaintext could mean either place or title text, likely to be place text
        //     //@ means user search ex: @Reymark
        //     var navSearchText = $("input#navbar-search").val();
        //     var command = "search";
        //     $.post('php/search_dealer.php', {query: navSearchText, command: command}, function(data)
        //     {
        //         alert(data);
        //     }); 
        // });
        
          
        </script>   
    </body>
</html>