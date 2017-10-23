<!-- Team Monday -->
<?php
session_start();

if(!isset($_SESSION['id'])) # if user is already logged in, redirect to logged in page.
{
  header('Location: index.php');
}
/**************************************** FETCHING DATA FROM THE DB *************************************************************/
      include_once('connection.php');
      $db = new Connection();
      $db = $db->dbConnect();

            $currentUsrName;
            GLOBAL $currentFName;
            $currentEmailFull;
            $currentEmail1;
            GLOBAL $currentEmail2;
            $emailPointer = 0;
            
        
            $query = $db->prepare("SELECT * FROM users WHERE id = ?"); #BINARY makes the password search case-sensitive.
            $query->bindparam(1, $_SESSION['id']);

            $query->execute();
            $currentUsrName = $query->fetch()['username'];
            $query->execute();
            $currentFName = $query->fetch()['fullname'];
            $query->execute();
            $currentEmailFull = $query->fetch()['email'];

            while ($currentEmailFull{$emailPointer} != '@'){
              $currentEmail1 = $currentEmail1.$currentEmailFull{$emailPointer};
              $emailPointer++;
            }

            $emailPointer++;
            while ($emailPointer < strlen($currentEmailFull)){
              $currentEmail2 = $currentEmail2.$currentEmailFull{$emailPointer};
              $emailPointer++;
            }

            $currentBio;
            $query2 = $db->prepare("SELECT bio FROM userinfo WHERE id = ?"); #BINARY makes the password search case-sensitive.
            $query2->bindparam(1, $_SESSION['id']);
            $query2->execute();
            $currentBio = $query2->fetch()['bio'];

/*****************************************************************************************************************************************/

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
    <link href="css/navbar.css" rel="stylesheet"> 
    <link href="css/user-settings.css" rel="stylesheet">

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
              <div class="row">
                  <div class="col-lg-offset-4 col-md-offset-4 col-xs-offset-4 col-lg-12"><h2>User Settings</h2></div>

              </div>
              <!--<div class="row"> 
                  
                        <div class="input-group">
                            <h4 class="col-lg-offset-8">Change profile picture</h4>
                            <label class="input-group-btn">
                                <span class="btn btn-default" type = "submit">
                                    Browse photos&hellip; <input type="file" id="img" style="display: none" multiple></input>                             
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly style="width:15%;margin-top:14px;" id = "place-text">
                        </div>       
                </div> -->
        <form class = "form-horizontal" role = "form">
                
              
           
                <div class = "form-group">
                    <label for = "Username" class = "col-sm-4 col-lg-5 control-label">Username</label>
                    <div class = "col-sm-6 col-md-6 col-lg-3">
<!------------------------------------------------------------------------------------------------------------------------------------------------------->
                    <?php

                     echo  "<input type = \"text\" class = \"form-control\" id = \"Username\" placeholder = '".$currentUsrName."' disabled>"; ?> <!-- disabled can also be readonly, open for discussion chuchu-->
<!------------------------------------------------------------------------------------------------------------------------------------------------------->
                    </div>
                </div>

                <div class = "form-group">
                    <label for = "Fullname" class = "col-sm-4 col-lg-5 control-label">Full Name</label>

                    <div class = "col-sm-6 col-md-6 col-lg-3">

                      <?php
                        echo "<input type = \"text\" class = \"form-control\" id = \"Fullname\" style= \"text-transform: capitalize;\" placeholder = '".$currentFName."'>";
                        ?>
                    </div>
                </div>

                <div class = "form-group">
                    <label for = "Email" class = "col-sm-4 col-lg-5 control-label">Email</label>
                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <div class="input-group">

                          <?php
                            echo "<input type = \"text\" class = \"form-control\" id = \"Email\" placeholder = '".$currentEmail1."' >"; ?>
                            <div class="input-group-addon">@</div>
                            <select id="EmailSelect" class="selectpicker form-control">

                              <?php
                              if ($currentEmail2 == 'gmail.com'){
                                echo "<option selected>gmail.com</option>";
                                echo "<option>yahoo.com</option>";
                              }
                              else if ($currentEmail2 == 'yahoo.com'){
                                echo "<option selected>yahoo.com</option>";
                                echo "<option>gmail.com</option>";
                              }
                                ?>

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
                            <label id="wrongusrPassword"></label>
                    </div>

                    <label for = "Password" class = "col-sm-4 col-lg-5 control-label">Re-enter New Password</label>

                    <div class = "col-sm-6 col-md-6 col-lg-3">
                        <div class="input-group">
                            <input type = "password" class = "form-control" id = "Password2" placeholder = "Re-enter New Password" autocomplete="new-password">
                            <span class = "input-group-btn">
                                <button class = "btn btn-default" type = "button" id="seePwdBtn2"><span class="glyphicon glyphicon-eye-close"></span></button>
                        </div>
                            <label id="wrongusrPassword2"></label>
                    </div>
                </div>

                <div class = "form-group">
                    <label for = "yeah" class = "col-sm-4 col-lg-5 control-label">Change profile picture</label>
                    <div class="input-group col-sm-6 col-md-6 col-lg-3">
                           
                            <label class="input-group-btn" style="padding-left:15px;">
                                <span class="btn btn-default" type = "submit">
                                    Browse photos&hellip; <input type="file" id="img" style="display: none"></input>                             
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly style="width:92%;" id = "place-text">
                    </div>   
                </div>
              
              <div class = "form-group">
                    <label for = "bio" class = "col-sm-4 col-lg-5 control-label">Change bio</label>

                    <div class = "textarea-div col-sm-6 col-md-6 col-lg-3">
                        <textarea class="form-control" id="bio" placeholder="<?php echo $currentBio; ?>"></textarea>
                         
                    </div>
                    
                </div>
    

                <div class = "form-group">
                    <div class = "col-xs-offset-8 col-sm-offset-8 col-md-offset-8 col-lg-offset-7 col-sm-2 col-md-2 col-lg-1 col-xs-4">
                        <button type = "button" class = "btn btn-default btn-block" id="bSaveChanges">Save</button>
                    </div>
                </div>

            </form>
          </div>
      </div>

          <!-- Sign Up script -->
      <script>
        var uploadList; //for avatar
         var postdropdown = document.getElementById("upload-select");
        
          
       
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
        $(function() //btn btn-default runs this
        {
            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() 
            {
                var input = $(this);
                var numFiles = input.get(0).files ? input.get(0).files.length : 1; //get(0) is the input child of the span parent
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, ''); //string escapes
                input.trigger('fileselect', [numFiles, label]); // 'fileselect' is what the identifier of our following jquery will see it as
                // alert(input.val().get(1));
                // alert(input); // [object Object]
                // alert(input.get(0)); // [object HTMLInputElement]
                // alert(input.get(0).getAttribute("id")); //file
                //alert(input.get(0).getAttribute("style")); //display: none
                // alert(input.get(0).files); //filelist
                // alert(input.get(0).files[0]); //file
                uploadList = new FormData();
                for(var i = 0; i < input.get(0).files.length; i++)
                {
                    // alert((input.get(0).files[i]).name +" content " +i); //displays all filenames
                    uploadList.append('file-'+i, input.get(0).files[i]);
                }

            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() 
            {
                $(':file').on('fileselect', function(event, numFiles, label) 
                {
                    var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;
                    if( input.length ) 
                    {
                        input.val(log);
                    } 
                    else 
                    {
                        if( log ) alert("file select error" +log);
                    }
                });
            });
        });
        function filter()
        {
            var field = document.getElementById('Fullname');
            field.value = field.value.replace(/[^a-zA-Z ]/g,"");
        }
        
        $(document).ready(function()
        {
            $('input#Fullname').keyup(function()
            {
                filter();
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

            $("#seePwdBtnModal2").click(function()
            {
                var password = document.getElementById('Password-modal2');
                var seePwdBtn = document.getElementById('seePwdBtnModal2');
                if(password.type=='password')
                    {
                        password.type='text';
                        $(seePwdBtn2).find(".glyphicon").removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
                    }
                else{
                    password.type='password';
                    $(seePwdBtn2).find(".glyphicon").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
                }
            })
            $("#seePwdBtn2").click(function()
            {
                var password = document.getElementById('Password2');
                var seePwdBtn = document.getElementById('seePwdBtn2');
                if(password.type=='password')
                    {
                        password.type='text';
                        $(seePwdBtn2).find(".glyphicon").removeClass("glyphicon-eye-close").addClass("glyphicon-eye-open");
                    }
                else{
                    password.type='password';
                    $(seePwdBtn2).find(".glyphicon").removeClass("glyphicon-eye-open").addClass("glyphicon-eye-close");
                }
            })
          $("#bSaveChanges").click(function()
          {
            filter();
            var password = $('input#Password').val();
            var password2 = $('input#Password2').val();

              //Combining email
            var email = $('input#Email').val();
            email = $.trim(email);
            
            var email2 = $('select#EmailSelect').val();
            var emailFinal = email + '@' + email2;
            emailFinal = $.trim(emailFinal);
            
              //Makes the first letters of fullname to capital letters.
            var fullnameArray = $('input#Fullname').val().split(' ');
            var fullname = '';
              for(i = 0; i < fullnameArray.length ; i++)
                  {
                      fullname = fullname + ' '+ capitalize(fullnameArray[i]);
                  }
            fullname = $.trim(fullname);
              //end of making 1st letters capital            

              var bio = $('#bio').val();

              if(password != password2)  {
                  $('label#wrongusrPassword2').css("color","red");
                  $('label#wrongusrPassword2').text("Error, both password fields must match.");
              } else{
                    var hasFiles = document.getElementById("place-text").value != '';
                    $.post('ajax/savechanges_process.php', {password: password, email:emailFinal, fullname: fullname, bio:bio, avatarchanged: hasFiles}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
                    {             //data there is what php will return or "echo"
                        if(data) // is true
                        {
                            console.log(data);
                            alert("Profile info saved.");
                            // window.location.href = 'user-settings.php'; //basically refreshes the page.
                            // let's make it so that when we save our changes, we get "Your Settings have been Saved."
                            if(hasFiles) //user decided to change his avatar
                            {
                                $.ajax( 
                                { 
                                    url: 'php/uploadAvatar.php',
                                    data: uploadList,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    method: 'POST',
                                    type: 'POST',
                                    success: function(data)
                                    {
                                        
                                        var ext = data;
                                        var uid = "<?php echo $_SESSION['id']; ?>";
                                        var path = "/CapturePinasWPTeamMonday/images/userimages/u" +uid +"." +ext;

                                        $.post('ajax/db_dealer.php', {type:"set", command:"userAvatar", path: path});
                                    }
                                });
                            }

                            window.location.href = 'user-settings.php'; //moves us in
                        }
                        else
                        {
                           alert("No info changed.");
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

<!--
    THINGS TO DO
        >password field condition if empty
        >maybe add a pre-edit stage to this webpage.
-->
