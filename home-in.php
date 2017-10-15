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
                        <li><a href="#">Profile</a></li>
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
      <div class="container" id ="home-posts">
          <div class="col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container">
             <div class="post" style="padding-bottom:10px;">  
                <div class="row">
                    <p style="margin-top:5px;"><b>Make a post</b></p>
                    <p id="line-1"></p>
                </div>
                <div class="row">  
                        <div class="input-group">
                            
                            <label class="input-group-btn">
                                <span class="btn btn-default">
                                    Browse photos&hellip; <input type="file" id="file" style="display: none" multiple>
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly style="width:30%;">
                        </div>       
                </div>
                <div class="row">
                     <div class="form-inline" id="upload-post-select">                             
                          <label for="sel1" style="padding-right:5px;">Select place </label>
                          <select class="form-control" id="upload-select">
                              <option>Albay</option>
                              <option>Banaue</option>
                              <option>Bataan</option>
                              <option>Batanes</option>
                              <option>Batangas</option>
                              <option>Benguet</option>
                              <option>Bohol</option>
                              <option>Bulacan</option>
                              <option>Camarines Norte</option>
                              <option>Camarines Sur</option>
                              <option>Capiz</option>
                              <option>Cavite</option>
                              <option>Cebu</option>
                              <option>Davao</option>
                              <option>Ilocos Norte</option>
                              <option>Ilocos Sur</option>
                              <option>Laguna</option>
                              <option>Leyte</option>
                              <option>Marinduque</option>
                              <option>Negros Occidental</option>
                              <option>Negros Oriental</option>
                              <option>Nueva Ecija</option>
                              <option>Palawan</option>
                              <option>Pampanga</option>
                              <option>Pangasinan</option>
                              <option>Quezon</option>
                              <option>Romblon</option>
                              <option>Sarangani</option>
                              <option>Sultan Kudarat</option>
                              <option>Surigao del Norte</option>
                              <option>Surigao del Sur</option>
                              <option>Tawi tawi</option>
                              <option>Zambales</option>
                              <option>Zamboanga</option>
                          </select>
                        </div>
                </div>
                 <div class="row">
                     <b> Description </b>
                        <br/>
                        <div class="textarea-div">
                            <textarea class="form-control" id="upload-textarea" placeholder="Enter description.."></textarea>
                        </div>
                     <button type="button" class="btn btn-default" id="upload-button" style="float:right;margin-right:35px;">Upload</button>
                 
                 </div>
             </div>
          </div>
            
      </div><!-- Make iterative -->
        <!-- more posts button -->
      
    <div class="wrapper">
        <button type="button" class="btn btn-default" onclick="loadPost()" id="load-more-button">Load More Posts</button>
    </div>

    <script>
        $(document).ready(function(){ 
              $('#places-dropdown').on('click',function(e)
                   {
                        $('#topic').val($(e.target).text());
                        //$('#topic').Text($(e.target).text());
                        $('#places-form').submit();
                   });
        });
        var off = 0;
        var mode = "home";//this decides how the arrangement of posts appear
        //choices are {string} "home" or "highest"
        window.onload = doSet();
        function doSet() //actually prepares navbar is what set does
        {
            var passed = 'getId';

            $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
            {                                                               //data there is what php will return or "echo"
                $('a#nav_name_user').text(data+' ');
                $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
            });

            //NOTE offset is 0 because this is the FIRST TIME LOAD of the page. Before the "more" is clicked.
            $.post('ajax/db_dealer.php', {type: "search", command: mode, offset: 0}, function(data)
            {
                // alert(data); //data now contains JSON formatted goods
                createPostLite(document.getElementById('home-posts'), data, 0);
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
        
        $(function() {

      // We can attach the `fileselect` event to all file inputs on the page
      $(document).on('change', ':file', function() {
        var input = $(this),
            numFiles = input.get(0).files ? input.get(0).files.length : 1,
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
          alert(input.val().get(1));
      });

      // We can watch for our custom `fileselect` event like this
      $(document).ready( function() {
          $(':file').on('fileselect', function(event, numFiles, label) {

              var input = $(this).parents('.input-group').find(':text'),
                  log = numFiles > 1 ? numFiles + ' files selected' : label;

              if( input.length ) {
                  input.val(log);
              } else {
                  if( log ) alert(log);
              }

          });
      });
  
});
    </script>      

  </body>
</html>
