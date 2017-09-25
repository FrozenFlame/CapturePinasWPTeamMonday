<!DOCTYPE html>
<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/signup.css" rel="stylesheet">

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
                <a class="navbar-brand" href="index.php">Capture Pinas</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    
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
        <form action = "php/login_process.php" method="post"> <!--php functionality inserted in form tag-->
          <div class="form-group">
            <label for="Username" class="form-control-label">Username</label>
            <input type="text" class="form-control" name="usrname" id="Username-modal" placeholder="Enter Username">
            <!--name="usrname" is what php will use to reference this-->
          </div>
            
          <div class="form-group">
            <label for="Password" class="form-control-label">Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" id="Password-modal" placeholder="Enter Password" autocomplete="new-password"></input>
                    <span class = "input-group-btn">
                    <button class = "btn btn-default" type = "button" id="seePwdBtnModal"><span class="glyphicon glyphicon-eye-close"></span></button>
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
    <!-- End of Modal -->
      
    
      <div class="login-block" >
          <div class="form-block">
              <div class="row" style="padding: 0px 50px 20px">
                  <div class="col-lg-offset-4 col-md-offset-4 col-xs-offset-4 col-lg-12"><h2>User Settings</h2></div>
            
              </div>
            <form class = "form-horizontal" role = "form">
                <div class = "form-group">
                    <label for = "Username" class = "col-sm-4 col-lg-5 control-label">Username</label>
                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <input type = "text" class = "form-control" id = "Username" placeholder = "display current username + make uneditable(?)">
                    </div>
                </div>
                
                <div class = "form-group">
                    <label for = "Fullname" class = "col-sm-4 col-lg-5 control-label">Full Name</label>

                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <input type = "text" class = "form-control" id = "Fullname" style="text-transform: capitalize;" placeholder = "Current Name (editable ba dapat or no?)">
                    </div>
                </div>            
                
                <div class = "form-group">
                    <label for = "Email" class = "col-sm-4 col-lg-5 control-label">Email</label>
                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <div class="input-group">
                            <input type = "text" class = "form-control" id = "Email" placeholder = "Current Email">
                            <div class="input-group-addon">@</div> 
                            <select id="EmailSelect" class="selectpicker form-control">
                                <option selected>gmail.com</option>
                                <option>yahoo.com</option>
                            </select> 
                        </div>
                    </div>
                </div>  
               
                
               
                
                 <div class = "form-group">
                        <label for = "Password" class = "col-sm-4 col-lg-5 control-label">Password</label>
                    
                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <div class="input-group">
                            <input type = "password" class = "form-control" id = "Password" placeholder = "Enter New Password" autocomplete="new-password">
                            <span class = "input-group-btn">
                                <button class = "btn btn-default" type = "button" id="seePwdBtn"><span class="glyphicon glyphicon-eye-close"></span></button>
                        </div> 
                            <label id="wrongusrSignup"></label>
                    </div>
                    
                    <label for = "Password" class = "col-sm-4 col-lg-5 control-label">Re-enter New Password</label>
                    
                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <div class="input-group">
                            <input type = "password" class = "form-control" id = "Password2" placeholder = "Re-enter New Password" autocomplete="new-password">
                            <span class = "input-group-btn">
                                <button class = "btn btn-default" type = "button" id="seePwdBtn"><span class="glyphicon glyphicon-eye-close"></span></button>
                        </div> 
                            <label id="wrongusrSignup"></label>
                    </div>
                </div>
                 
                 
                    
                <div class = "form-group">
                    <div class = "col-xs-offset-8 col-sm-offset-8 col-md-offset-8 col-lg-offset-7 col-sm-2 col-md-2 col-lg-1 col-xs-4">
                        <button type = "button" class = "btn btn-default btn-block" id="bSignUp">Save Changes</button>
                    </div>
                </div>

            </form>
          </div>
      </div>
          
          <!-- Sign Up script -->
      <script>
          
           function capitalize(str) 
          { // string with alteast one character 
               if (str && str.length >= 1) 
               { 
                   var firstChar = str.charAt(0); 
                   var remainingStr = str.slice(1); 
                   str = firstChar.toUpperCase() + remainingStr; 
               } 
              return str;
           }
          
        $(document).ready(function()
        {
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
            $("#seePwdBtn").click(function()
            {
                var password = document.getElementById('Password');
                var seePwdBtn = document.getElementById('seePwdBtn');
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
          $("#bSignUp").click(function()
          {
            var username = $('input#Username').val();
            var password = $('input#Password').val();
              
              //Combining email
            var email = $('input#Email').val();
              var email2 = $('select#EmailSelect').val();
              email = email + '@' + email2;
              
              //Makes the first letters of fullname to capital letters.
            var fullnameArray = $('input#Fullname').val().split(' ');
              var fullname = '';
              for(i = 0; i < fullnameArray.length ; i++)
                  {
                      fullname = fullname + ' '+ capitalize(fullnameArray[i]);
                  }
              //end of making 1st letters capital
              
                if($.trim(username)=='' || $.trim(password)=='' || $.trim(email) == '' 
                   || fullname == '')
                {
                    $('label#wrongusrSignup').css("color","red");
                    $('label#wrongusrSignup').text("Please fill up all fields.");
                } else{
                   
                    $.post('ajax/signup_process.php', {username: username, password: password,email:email,fullname:fullname}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
                    {             //data there is what php will return or "echo"
                        if(data) // is true
                        {  
                            alert("Successful");
                            window.location.href = 'home-in.php'; //moves us in
                        }
                        else
                        {
                           alert("Failed");
                        }                         
                    });      
                }
            });
            
            //Login Code
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

