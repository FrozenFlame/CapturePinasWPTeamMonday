<!-- Team Monday -->
<?php
session_start();

if(!isset($_SESSION['id'])) # if user is already logged in, redirect to logged in page.
{
  header('Location: index.php');
}

$userid = $_POST['userid'];
?>
<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src= "post/post-user-profile.js"> </script>
    <link href="css/user-profile.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Nav bar -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CapturePinas</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                        
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Places <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span></a>
                        <ul class="dropdown-menu" id="places-dropdown">
                            <form action="search_results.php" method="POST" id="places-form">
                            <input type="hidden" name="query" id="topic">
                            <li class="places-li">Albay</li>
                            <li class="places-li">Banaue</li>
                            <li class="places-li">Bataan</li>
                            <li class="places-li">Batanes</li>
                            <li class="places-li">Batangas</li>
                            <li class="places-li">Benguet</li>
                            <li class="places-li">Bohol</li>
                            <li class="places-li">Bulacan</li>
                            <li class="places-li">Camarines Norte</li>
                            <li class="places-li">Camarines Sur</li>
                            <li class="places-li">Capiz</li>
                            <li class="places-li">Cavite</li>
                            <li class="places-li">Cebu</li>
                            <li class="places-li">Davao</li>
                            <li class="places-li">Ilocos Norte</li>
                            <li class="places-li">Ilocos Sur</li>
                            <li class="places-li">Laguna</li>
                            <li class="places-li">Leyte</li>
                            <li class="places-li">Marinduque</li>
                            <li class="places-li">Negros Occidental</li>
                            <li class="places-li">Negros Oriental</li>
                            <li class="places-li">Nueva Ecija</li>
                            <li class="places-li">Palawan</li>
                            <li class="places-li">Pampanga</li>
                            <li class="places-li">Pangasinan</li>
                            <li class="places-li">Quezon</li>
                            <li class="places-li">Romblon</li>
                            <li class="places-li">Sarangani</li>
                            <li class="places-li">Sultan Kudarat</li>
                            <li class="places-li">Surigao del Norte</li>
                            <li class="places-li">Surigao del Sur</li>
                            <li class="places-li">Tawi tawi</li>
                            <li class="places-li">Zambales</li>
                            <li class="places-li">Zamboanga</li>
                            </form>

                        </ul>
                    </li>
                    <li><a href="#">About Us</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <div class="col-lg-12">
                         <form class="navbar-form" role="search" method="POST" action="search_results.php"> <!-- method="<post/get>" action="<location of php>" -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name = "query" id="navbar-search">
                                <div class="input-group-btn">
                                <button class="btn btn-default" type="submit" id ='navbar-search-button'><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </li>
                    <li class="dropdown" id="profile-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="nav_name_user"></a>
                        <ul class="dropdown-menu">
                        <li><a href="#" onclick="goToMyProfile(this)">Profile</a></li>
                        <li><a href="user-settings.php">User Settings</a></li>
                        <li><a href="ajax/logout_process.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Nav bar -->
      <br>
      <div class="container-fluid container-user-profile row">
          <div class="row">
              <div class="col-lg-3 profile-details">
                  <div class="media">
                            <img class="d-flex mr-3 profile-user-image pull-left" id= "user-image"/>
                            <div class="media-body">
                                <h4 style="padding-top:10px;"><b id="profile-name"></b></h4>
                                
                                
                            </div>
                    </div>
                  <p id="line" style="margin-bottom:auto;"></p>
                  <p id="bio" style="padding-top:5px;"></p>
              </div>
              <div id="home-posts" class="col-lg-6">
              </div>
          </div>
      </div>
      <!-- Make iterative -->
        <!-- more posts button -->
      
    <div class="wrapper">
        <button type="button" class="btn btn-default" onclick="loadPost()" id="load-more-button" style="margin-top:10px;">Load More Posts</button>
    </div>

    <script>
        $(document).ready(function()
        { 
            $('#places-dropdown').on('click',function(e)
            {
                $('#topic').val($(e.target).text());
                //$('#topic').Text($(e.target).text());
                $('#places-form').submit();
            });
        });
        var off = 0;
        var mode = "user-profile-id";//this decides how the arrangement of posts appear
        
        //choices are {string} "user-profile", "home" or "highest"
        window.onload = doSet();
        function doSet() //actually prepares navbar is what set does
        {
            var passed = 'getId';

            $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
            {                                                               //data there is what php will return or "echo"
                // $('b#profile-name').text(data);
                $('a#nav_name_user').text(data+' ');
                $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
            });

            //NOTE offset is 0 because this is the FIRST TIME LOAD of the page. Before the "more" is clicked.
            var _userid = "<?php echo $userid ?>";
            $.post('ajax/db_dealer.php', {type: "search", command: mode, offset: 0 , userid: _userid}, function(data)
            {
                //alert(data);
                // alert(data); //data now contains JSON formatted goods
                createPostLite(document.getElementById('home-posts'), data, 0);
            });
            $.post('ajax/db_dealer.php', {type: "get", command: "getUserProfileById", userid: _userid}, function(data)
            {
                //alert(data);
                //var profile;
               
                profile = JSON.parse(data);
                $('b#profile-name').text(profile.fullname);
                var img = document.getElementById("user-image");
                img.setAttribute("src",profile.filepath);
                var name = document.getElementById("profile-name");
                $('p#bio').text(profile.bio);
                 
                //alert(data);
                // alert(data); //data now contains JSON formatted goods
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
        function loadPost()
        {
            off+=4;
            $.post('ajax/db_dealer.php', {type: "search", command: mode, offset: off}, function(data)
            {
                // alert(data); //data now contains JSON formatted goods, debugging tool
                createPostLite(document.getElementById('home-posts'), data, off);
            });
        }
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
    </script>      

  </body>
</html>
