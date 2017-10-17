<!-- Team Monday -->
<?php
session_start();
$isGuest;
if(!isset($_SESSION['id'])) # if user is a guest.
{
//   header('Location: index.php');
    $isGuest = TRUE;
}
if(!isset($_SESSION['mode']))
{
    $_SESSION['mode']='home';
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
    <script src= "js/navbar.js"> </script>
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
      <br>
      <div class="container" id ="home-posts">
          <div class="col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container" id="upload-container" style="cursor:pointer;">
             <div class="post" id="div-upload-header">  
                <div class="row">
                    <p style="margin-top:5px;" id="make-post-button"><b>Make a post</b></p>
                </div>
            <div id="upload-div">
                <div class="row">  
                    <p id="line-1"></p>
                        <div class="input-group">
                            
                            <label class="input-group-btn">
                                <span class="btn btn-default" type = "submit">
                                    Browse photos&hellip; <input type="file" id="img" style="display: none" multiple></input><!-- 'Browse Photos...' button-->                                
                                </span>
                            </label>
                            <input type="text" class="form-control" readonly style="width:30%;" id = "place-text">
                        </div>       
                </div>
                <div class="row">
                     <div class="form-inline" id="upload-post-select">                             
                          <label for="sel1" style="padding-right:5px;">Select place </label>
                          <select class="form-control" id="upload-select">
                              <option selected="selected">Albay</option>
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
                     <p style="margin:auto;"><b> Title </b></p>
                     <div class="textarea-div">
                        <input type="text" class="form-control" placeholder="Enter title" id="post-title"></input>
                     </div>
                     <b> Where </b>
                     <br/>
                     <div class="textarea-div">
                        <input type="text" class="form-control" placeholder="Enter location (optional)" id="post-location"></input>
                     </div>
    
                     <b> Description </b>
                        <br/>
                        <div class="textarea-div">
                            <textarea class="form-control" id="upload-textarea" placeholder="Enter description.."></textarea>
                        </div>
                    <button type="button" class="btn btn-default" id="slide-up-button"><span class="glyphicon glyphicon-chevron-up"
                                                data-toggle="tooltip" title="Click to slide up"></span></button>
                     <button type="button" class="btn btn-default" id="upload-button" style="float:right;margin-right:35px;" onclick ="upload()">+Post</button>
                    
                 </div>
          </div>
             </div>
          </div>
        <div class="col-lg-offset-2 col-offset-xs-0 col-sm-8 col-xs-12" >
              <div class="post" style="padding-bottom:10px;padding-top:10px;">
                  <div class="row">
                      <p class="col-lg-2" style="width:15%;"><b>Sort by:</b><p>
                  <button type="button" class="btn btn-default col-lg-2" style="margin-right:10px;" id="latest-time-button">Newest</button>
                  <button type="button" class="btn btn-default col-lg-2" style="margin-right:10px;" id="oldest-time-button">Oldest</button>
                  <button type="button" class="btn btn-default col-lg-2" style="margin-right:10px;" id="highest-like-button">Highest Ratings</button>
                  <button type="button" class="btn btn-default col-lg-2" style="margin-right:10px;" id="most-fave-button">Most Favorites</button>
                  </div>
              </div>
          </div>

      </div>

            
      <!-- Make iterative -->

    
    <!-- more posts button -->
    <div class="wrapper">
        <button type="button" class="btn btn-default" onclick="loadPost()" id="load-more-button">Load More Posts</button>
    </div>

    <script>

        var isGuest = "<?php echo $isGuest ?>";
        var uploadList;
        
        var postdropdown = document.getElementById("upload-select");
        var placeSelected = "Albay";

        $(document).ready(function()
        { 
            
            checkSession();
            $("#highest-like-button").click(function(){
                var mode = "highest";
                $.post("php/sessionSetter.php", {"modePassed": mode});
                window.location = "home-in.php";
                
            });
            $("#latest-time-button").click(function(){
                var mode = "home";
                $.post("php/sessionSetter.php", {"modePassed": mode});
                window.location = "home-in.php";
            });
            $("#oldest-time-button").click(function(){
                var mode = "oldest";
                $.post("php/sessionSetter.php", {"modePassed": mode});
                window.location = "home-in.php";
            });
             $("#most-fave-button").click(function(){
                var mode = "favorites";
                $.post("php/sessionSetter.php", {"modePassed": mode});
                window.location = "home-in.php";
            });
            
            /*$("#latest-time-button").click(function(){
                
            });*/
            
           
            $("#example").popover({
                placement: 'bottom',
                html: 'true',
                title : '<span class="text-info"><strong>title</strong></span>'+
                        '<button type="button" id="close" class="close" onclick="$(&quot;#example&quot;).popover(&quot;hide&quot;);">&times;</button>',
                content : 'test'
            });
            $("#make-post-button").click(function(){
                $("#upload-div").slideDown();
                var div = document.getElementById("div-upload-header");
                div.setAttribute("style","padding-bottom:10px;");
                var container = document.getElementById("upload-container");
                container.removeAttribute("style");
            });
            $("#slide-up-button").click(function(){
                $("#upload-div").slideUp();
                var div = document.getElementById("div-upload-header");
                div.removeAttribute("style");
                var container = document.getElementById("upload-container");
                container.setAttribute("style","cursor:pointer;");
            });
        });
        
        function checkSession(){
            var sessionMode = "<?php echo $_SESSION['mode'] ?>";
                if(sessionMode=="home"){
                    $("#latest-time-button").attr("style","background-color:#0b2b10;color:white;margin-right:10px;");
                    $("#latest-time-button").attr("class","btn btn-default col-lg-2 disabled");
                } else if(sessionMode=="highest") {
                    $("#highest-like-button").attr("style","background-color:#0b2b10;color:white;margin-right:10px;");
                    $("#highest-like-button").attr("class","btn btn-default col-lg-2 disabled");
                }
                else if(sessionMode=="oldest") {
                    $("#oldest-time-button").attr("style","background-color:#0b2b10;color:white;margin-right:10px;");
                    $("#oldest-time-button").attr("class","btn btn-default col-lg-2 disabled");
                }
                else if(sessionMode=="favorites") {
                    $("#most-fave-button").attr("style","background-color:#0b2b10;color:white;margin-right:10px;");
                    $("#most-fave-button").attr("class","btn btn-default col-lg-2 disabled");
                }
        }
        
        var uploadList;
        
        var postdropdown = document.getElementById("upload-select");
        
        var off = 0;
        // var mode = "home";//this decides how the arrangement of posts appear
        //choices are {string} "user-profile", "home" or "highest"
        var mode = "<?php echo $_SESSION['mode']; ?>";
        window.onload = doSet();
        function doSet() //actually prepares navbar is what set does
        {
            $('#upload-select').on('change', function(e)
            {
                placeSelected = postdropdown.options[postdropdown.selectedIndex].value
            });
            //NOTE offset is 0 because this is the FIRST TIME LOAD of the page. Before the "more" is clicked.
            $.post('ajax/db_dealer.php', {type: "search", command: mode, offset: 0}, function(data)
            {
                // alert(data); //data now contains JSON formatted goods
                createPostLite(document.getElementById('home-posts'), data, 0);
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
        /**
        *     @author Jarvis  
        */
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
                uploadList.append('qty', input.get(0).files.length);

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

        function upload()
        {   
            //variables found above:
            // var uploadList;
            /**
            *   @author Denzel
            */
            var numOfSuccessfulUploads;
            var pID;
            
            //uploading of files
            var hasFiles = document.getElementById("place-text").value != '';
            var hasTitle = document.getElementById("post-title").value.trim() != '';
            var hasDescription = document.getElementById("upload-textarea").value.trim() != '';
            if(!(hasFiles && hasTitle && hasDescription))
            {
                alert("Please make sure you:\n- Selected files to upload\n- Have a title\n- Have a description.");
            }
            else
            {
                var result; // result will be an array, 0 is the message, 1 is the number of successful uploads
                
                $.post('ajax/db_dealer.php', {type:"get", command:"getLastPostId"}, function(data)
                {
                    // var lastpostid = ;
                    pID = 0;
                    pID = parseInt(data)+1;
                    uploadList.append('pid', pID);
                    // for (var pair of uploadList.entries()) {
                    // console.log(pair[0]+ ', PUSANG ' + pair[1]); 
                    // }
                    /*I kid ye not my friends. I suspected this too late
                        I knew that the $.ajax was running earlier than this $.post method despite their positioning in the code.
                        Now that I moved the $.ajax function in here, it guarantees our $.post must complete BEFORE this piece of... nanites executes
                    */
                    $.ajax( 
                    { 
                        url: 'php/uploadFile.php',
                        data: uploadList,
                        cache: false,
                        contentType: false,
                        processData: false,
                        method: 'POST',
                        type: 'POST',
                        success: function(data)
                        {
                            result = JSON.parse(data);
                            /*alert(result[0]);
                            alert(result[1]);
                            alert(result[2]);*/
                            alert(result[0]);
                            // alert(result[2]);
                            numOfSuccessfulUploads = result[1];
                            //AND then this is where I discover the rest of the code must be shoved into this function. this is great.
                            //fun fact I just recently shoved it even deeper from the $.post to this $.ajax async gaming
                            //OKAY LAST TIME. Hopefully this is the last time. now I had to go inside the success: function
                            var post = new Object();
                            post.userid = "<?php echo $_SESSION['id']; ?>";
                            post.title = document.getElementById("post-title").value.trim();
                            var subPlace = document.getElementById("post-location").value.trim();
                            if(subPlace == '')
                                post.place = placeSelected;
                            else
                                post.place = subPlace +", " +placeSelected;
                            post.description = document.getElementById("upload-textarea").value.trim();
                            
                            post.path = new Array();
                            
                            var exts = JSON.parse(result[2]);
                            
                            for(var c = 0; c < numOfSuccessfulUploads; c++)
                                post.path.push("/CapturePinasWPTeamMonday/images/postimages/" +pID+"img" +(c+1) +"." +exts[c]);
                            // var c = 0;
                            // for(var extension of result[2])
                            // {
                            //     post.path.push("/CapturePinasWPTeamMonday/images/postimages/" +pID+"img" +(c++ +1) +"." +extension);
                            // }
                            
                            // alert(JSON.stringify(post) +" \n-post content");

                            $.post('ajax/db_dealer.php', 
                            {type:"set", command:"post",
                            postJSON: JSON.stringify(post)},
                            function(data)
                            {
                                //redirect to the post_page
                                // alert(data+"fake");
                                window.location = "post_page.php?post=" +pID;
                            });

                        }
                        
                    });

                });

                //  $.ajax( damn you inventor of jQuery. This slow and inefficient heap of trash won't last any longer 
                //     { 
                //         url: 'php/uploadFile.php',
                //         data: uploadList,
                //         cache: false,
                //         contentType: false,
                //         processData: false,
                //         method: 'POST',
                //         type: 'POST',
                //         success: function(data)
                //         {
                //             // result = JSON.parse(data);
                //             alert(data);
                //         }
                //     });
                
                
            }
        }
    </script>      

  </body>
</html>
