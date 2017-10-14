<!-- 
  Made By Jarvis
  This page is what happens if you select a specific post to show.
-->
<?php
  #variable declaration
  $hype = "HYYYYPE"; # THIS IS IT
   #just a test, the value we put here should come from the post that was selected, which will have its own logic some other time
?>

<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/post.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
        <div id ="postdiv">
            <div class="col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container">
                <div class="post">
                    <div class="row">
                        <!--<a href="#"><p><b id="post-name"></b></p></a> -->
                        <p id="post-title-p"><b id="post-title"></b></p>
                    </div>
                    <div class="row">
                        <div id="post-carousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators" id ="carousel-indicators">
                            </ol>

                            <!-- Wrapper for slides, also where we need to inject picture paths--> 
                            <div class="carousel-inner" id="carousel-inner">
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#post-carousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#post-carousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                            </div>
                    </div>
                    <div class="row">
                        <a href="#"><p><b id="post-name"></b></p></a>
                        <p>
                        in <b id="post-place"></b>
                        </p>
                        <p id="post-timestamp"></p>
                        <p id="post-description"></p>
                        <p id="line"></p> 
                        <button class="btn btn-default" type="button" id="post-like-btn"><text id = "post-likes">0</text> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
                        <button class="btn btn-default" type="button" id="post-unlike-btn"><text id = "post-dislikes">0</text>  <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
                        <p id="line"></p>

                        <!-- Comments Section -->
                        <b> Comments </b>
                        <br/>
                        <div class="textarea-div">
                            <textarea class="form-control" id="post-comment" placeholder="Enter a comment.."></textarea>
                            <button type="button" class="btn btn-default" id="textarea-button" >Comment</button>
                        </div>
                        <p id="line"></p>
                        <!-- passing postID value to comment loader -->
                        <?php include("comment_loader.php"); ?>
                    </div>
                    
                </div>
            </div>
        </div>
        
                
      <script>
          $(document).ready(function()
            {
                var postid = "<?php echo $postID ?>"; //this postid is what will show up, just for testing purposes
                // var postid = 1; 
                var passed = 'getPostInfo';
                var type = 'get';
                var post;
                if(postid > 0 )
                {
                $.post('ajax/db_dealer.php', {command: passed, type: type, postid: postid}, function(data)
                {
                    post = JSON.parse(data);
                    $('b#post-title').text(post[0].title);
                    
                    var command = 'getPostAuthor';
                    var userid = post[0].userid;
                    $.post('ajax/db_dealer.php', {command: command, type: type, author_id: userid}, function(data)
                    {
                        $('b#post-name').text(data);
                    }); 
                    $('b#post-place').text(post[0].place);
                    $('p#post-timestamp').text(post[0].timestamp);
                    $('p#post-description').text(post[0].description);
                    $('text#post-likes').text(post[0].likes);
                    $('text#post-dislikes').text(post[0].dislikes);
                    var liCar = [];
                    var len = post[0].path.length;
                    var olCarousel = document.getElementById("carousel-indicators");
                    for(var i = 0; i < len; i++)
                    {
                        var li = document.createElement("li");
                        li.setAttribute("data-target","#post-carousel");
                        li.setAttribute("data-slide-to", i);
                        // if(i == 0)
                        //     li.setAttribute("class","active");
                        liCar.push(li);
                    
                        (olCarousel);
                        olCarousel.appendChild(liCar[i]);
                        
                    }
                    liCar[0].setAttribute("class","active");
                    var divItem = [];
                    var inCarousel = document.getElementById("carousel-inner");
                    for(var i = 0; i < liCar.length; i++)
                    {
                        var item = document.createElement("div");
                        item.setAttribute("class","item");
                        var img = document.createElement("img");
                        img.setAttribute("src", post[0].path[i]);
                        img.setAttribute("alt","Image not found");
                        item.appendChild(img);
                        divItem.push(item);
                        document.getElementById("carousel-inner").appendChild(divItem[i]);
                    }
                    divItem[0].setAttribute("class","item active");
                    }); 
                    $("#post-like-btn").click(function()
                    {
                        var likes = parseInt($(this).text());
                        $(this).text(likes+1+' ');
                        $(this).append('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>');
                    });
                    $("#post-unlike-btn").click(function()
                    {
                        var likes = parseInt($(this).text());
                        $(this).text(likes+1+' ');
                        $(this).append('<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>');
                    });
                    }
                    else
                    {
                        document.getElementById("postdiv").innerHTML = "<h1>Sorry! This post does not exist!</h1>";
                        document.getElementById("postdiv").innerHTML += "<br/><h2> Redirecting in <b id=\"redirect\">5</b></h2>" 
                        var timeLeft = 4;
                        setInterval(function()
                        {
                            document.getElementById("redirect").innerHTML = timeLeft--;
                        }, 1000);
                        setTimeout(function () 
                        {
                            window.location.href = "index.php"; //will redirect to your blog page (an ex: blog.html)
                        }, 5000); //will call the function after 2 secs.
                    }
                
            });
            // }
            // else
            // {
            //     alert("no content");
            // }
         </script>
    </body>
</html>