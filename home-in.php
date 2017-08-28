<!-- Team Monday -->
<?php
session_start();

if(!isset($_SESSION['id'])) #if user is logged out, they'll be redirected home. Logic for other tabs.
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
    <link href="css/home-out.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <script>
    window.onload = function() 
    {
      window.location.href = ('php/prefield.php');
    }
    </script>
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
                <a class="navbar-brand" href="home-out.html">Capture Pinas</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="home-out.html">Home</a></li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Places <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Albay</a></li>
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
                            <li><a href="#">Davao(PD30)</a></li>
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
                    
                    <li><a href="#">Forums</a></li>
                    <li><a href="#">About Us</a></li>
                 
                </ul> 
                <ul class="nav navbar-nav navbar-right">
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
        <form>
          <div class="form-group">
            <label for="Username" class="form-control-label">Username</label>
            <input type="text" class="form-control" id="Username" placeholder="Enter Username">
          </div>
          <div class="form-group">
            <label for="Password" class="form-control-label">Password</label>
            <input class="form-control" id="Password" placeholder="Enter Password"></input>
          </div>
            
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>
    <!-- End of Modal -->
      
    <div class="intro-block">
      
        <div class="row">
          <div class="col-xs-12">
                <img class="img-responsive CapPinas1" src="images/CapturePinas2.jpg">
            </div>
          </div>
          
        </div>
      
      
      <div class="features-container">
        <div class="row">
          <div class="col-lg-12"><h2>FEATURES</h2></div>
          </div>
          <div class="row">
          <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/1.jpg">
                <h3>Share</h3>
                <p>Bla baiosdjasiodj absd nafaiodg basyudgsayu niofhyusbd basyudgasdaugd adsaydv v
              asdasbd dsad nifuhaygbf bbasgduho joiyibjdu bidgaybfdh ufhuvb hjfab js bkjgh erkavf stfskjd hdbdk'
              asjbfas dshgbusdf hj jkbjhdsjv dgfnrtfhajnf lkghnoi bKNFDFU</p>
                <p><a class="btn btn-default" href="#">View Details &raquo;</a></p>
              </div>    
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/2.jpg">
                <h3>Explore</h3>
                <p>Bla baiosdjasiodj absd nafaiodg basyudgsayu niofhyusbd basyudgasdaugd adsaydv v
              asdasbd dsad nifuhaygbf bbasgduho joiyibjdu bidgaybfdh ufhuvb hjfab js bkjgh erkavf stfskjd hdbdk'
              asjbfas dshgbusdf hj jkbjhdsjv dgfnrtfhajnf lkghnoi bKNFDFU</p>
                <p><a class="btn btn-default" href="#">View Details &raquo;</a></p>
              </div>
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/3.jpg">
                <h3>Socialize</h3>
                <p>Bla baiosdjasiodj absd nafaiodg basyudgsayu niofhyusbd basyudgasdaugd adsaydv v
              asdasbd dsad nifuhaygbf bbasgduho joiyibjdu bidgaybfdh ufhuvb hjfab js bkjgh erkavf stfskjd hdbdk'
              asjbfas dshgbusdf hj jkbjhdsjv dgfnrtfhajnf lkghnoi bKNFDFU</p>
                <p><a class="btn btn-default" href="#">View Details &raquo;</a></p>
              </div>
              
              <div class="col-sm-6 col-md-3">
                <img class="img-circle img-responsive" src="images/4.jpg">
                <h3>Experience</h3>
                <p>Bla baiosdjasiodj absd nafaiodg basyudgsayu niofhyusbd basyudgasdaugd adsaydv v
              asdasbd dsad nifuhaygbf bbasgduho joiyibjdu bidgaybfdh ufhuvb hjfab js bkjgh erkavf stfskjd hdbdk'
              asjbfas dshgbusdf hj jkbjhdsjv dgfnrtfhajnf lkghnoi bKNFDFU</p>
                <p><a class="btn btn-default" href="#">View Details &raquo;</a></p>
              </div>
          </div>
      </div>
      
  </body>
</html>