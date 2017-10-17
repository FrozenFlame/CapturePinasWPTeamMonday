<?php
session_start();
if(isset($_SESSION['id'])) # if user is already logged in, redirect to logged in page.
{
  header('Location: home-in.php');
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
    <link href="css/home-out.css" rel="stylesheet">

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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Places <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Albay</a></li>
                            <li><a href="#">Banaue</a></li>
                            <li><a href="#">Bataan</a></li>
                            <li><a href="#">Batanes</a></li>
                            <li><a href="#">Batangas</a></li>
                            <li><a href="#">Benguet</a></li>
                            <li><a href="#">Bohol</a></li>
                            <li><a href="#">Bulacan</a></li>
                            <li><a href="#">Camarines Norte</a></li>
                            <li><a href="#">Camarines Sur</a></li>
                            <li><a href="#">Capiz</a></li>
                            <li><a href="#">Cavite</a></li>
                            <li><a href="#">Cebu</a></li>
                            <li><a href="#">Davao</a></li>
                            <li><a href="#">Ilocos Norte</a></li>
                            <li><a href="#">Ilocos Sur</a></li>
                            <li><a href="#">Laguna</a></li>
                            <li><a href="#">Leyte</a></li>
                            <li><a href="#">Marinduque</a></li>
                            <li><a href="#">Negros Occidental</a></li>
                            <li><a href="#">Negros Oriental</a></li>
                            <li><a href="#">Nueva Ecija</a></li>
                            <li><a href="#">Palawan</a></li>
                            <li><a href="#">Pampanga</a></li>
                            <li><a href="#">Pangasinan</a></li>
                            <li><a href="#">Quezon</a></li>
                            <li><a href="#">Romblon</a></li>
                            <li><a href="#">Sarangani</a></li>
                            <li><a href="#">Sultan Kudarat</a></li>
                            <li><a href="#">Surigao del Norte</a></li>
                            <li><a href="#">Surigao del Sur</a></li>
                            <li><a href="#">Tawi tawi</a></li>
                            <li><a href="#">Zambales</a></li>
                            <li><a href="#">Zamboanga</a></li>
                            
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
                    <li><a href="signup.html"><span class="glyphicon glyphicon-user" ></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Nav bar -->
      
      <!-- Start of Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Login</h2>
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <div class="modal-body">
        <form > <!--php functionality inserted in form tag-->
          <div class="form-group">
            <label for="Username" class="form-control-label">Username</label>
              <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" name="usrname" id="Username-modal" placeholder="Enter Username">
            <!--name="usrname" is what php will use to reference this-->
              </div>
            
          </div>
            
          <div class="form-group">
            <label for="Password" class="form-control-label">Password</label>
                <div class="input-group">
                     <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" name="password" id="Password-modal" placeholder="Enter Password" autocomplete="new-password"></input>
                    <div class="input-group-btn">
                      <button class="btn btn-default" type="button" id="seePwdBtnModal">
                        <i class="glyphicon glyphicon-eye-close"></i>
                      </button>
                    </div>
                </div>
          </div>
          <label id="wrongusr"></label> <!--ajax will change this label if user enters invalid data -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id = "bloginmdl">Login</button>
      </div>
    </div>
  </div>
</div>
<!-- End of Login Modal -->
      
    <div class="intro-block">
      
        <div class="row">
          <div class="col-lg-12">
                <img class="img-responsive CapPinas1" src="images/CapturePinas2.jpg">
            </div>
          </div>
        </div>
      
      <div class="features-container">
        <div class="row">
          <div class="col-lg-12"><h2>FEATURES</h2></div>
          </div>
          <div class="row">
          <div class="col-sm-6 col-md-3" id="div1">
                <img class="img-circle img-responsive" src="images/1.jpg">
                <h3>Share</h3>
                <p>Share your experiences with your friends and loved ones as you travel around the Philippines! Upload
                your photos and add your personal comments and views about your trip to share to people you have already
                connected with! Tell everyone about your experience and how fun it is to travel to the places that you
                have visited!</p>
                <!--<p><a class="btn btn-default" href="#">View Details &raquo;</a></p>-->
              </div>    
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/2.jpg">
                <h3>Explore</h3>
                <p>Explore new regions that you haven't been to.. yet! Find new interesting places that you can plan your
                next trip on! See for yourself all the places that others have visited and mark them as your favourites to
                remember them by!</p>
                <!--<p><a class="btn btn-default" href="#">View Details &raquo;</a></p>-->
              </div>
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/3.jpg">
                <h3>Socialize</h3>
                <p>Let other people see your travels! Meet and connect with your fellow travelers that have been to the places
                that you have been! Or, meet people that have been to the places that you want to go to! People can also
                approach you about places you've been to that they haven't visited yet!</p>
                <!--<p><a class="btn btn-default" href="#">View Details &raquo;</a></p>-->
              </div>
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/4.jpg">
                <h3>Experience</h3>
                <p>Get a feel for a beautiful place through another's lenses! Re-visit your favourite landmarks through another
                person's perspective! Experience the thrill of travel and the rewarding sights you can have!</p>
                <!--<p><a class="btn btn-default" href="#">View Details &raquo;</a></p>-->
              </div>
          </div>
      </div>
      
      
      <script>
         //search part
         $(document).ready(function()
        { 
            $("#dropdown-button").click(function(){
                $("#places-dropdown").slideToggle();
            });
            $("#nav-name-user").click(function(){
                $("#user-dropdown").slideToggle();
            });
            $('#places-dropdown').on('click',function(e)
            {
                    $('#topic').val($(e.target).text());
                    //$('#topic').Text($(e.target).text());
                    $('#places-form').submit();
            });
            $('#upload-select').on('change', function(e)
            {
                placeSelected = postdropdown.options[postdropdown.selectedIndex].value
            });
        });
          //LOGIN CODE
        var attemptsRem = 5;
        $(document).ready(function()
        {
            $("#Password-modal").keyup(function(event){
                if(event.keyCode == 13){
                    $("#bloginmdl").click();
                }
            });
            
            $("#seePwdBtnModal").click(function()
            {
                var password = document.getElementById('Password-modal');
                var seePwdBtn = document.getElementById('seePwdBtnModal');
                if(password.type=='password')
                    {
                        password.type='text';
                        $(seePwdBtn).find(".glyphicon").removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
                    }
                else{
                    password.type='password';
                    $(seePwdBtn).find(".glyphicon").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
                }
            })
          $("#bloginmdl").click(function()
          {
            console.log("You clicked me");
            var user = $('input#Username-modal').val(); // $ jquery. input from id 'Username', then the method val() for its value.
            var pass = $('input#Password-modal').val();
            if($.trim(user) != '' && pass != '') //ignores empty fields
            { 
              $.post('ajax/login_process.php', {usern: user, passw: pass}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
              {                                                               //data there is what php will return or "echo"
                if(data)
                {  
                  $('label#wrongusr').text("");
                  window.location.href = 'home-in.php'; //moves us in as an example page.
                }
                else
                {
                  $('label#wrongusr').css("color","red");
                  $('label#wrongusr').text("Incorrect login details.");
                  attemptsRem--;
                }                         
              });         
            }
            
          });
        });
        
      </script>
  </body>
</html>