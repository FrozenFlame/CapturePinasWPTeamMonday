<!-- 
  Made By Jarvis
  This page is what happens if you select a specific post to show.
-->
<?php
  #variable declaration
  $hype = "HYYYYPE"; # THIS IS IT
  $postID = 3; #just a test, the value we put here should come from the post that was selected, which will have its own logic some other time
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
        <div class="col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container">
                    <div class="post">
                        <div class="row">
                            <!--<a href="#"><p><b id="post-name"></b></p></a> -->
                            <p id="post-title-p"><b id="post-title"></b></p>
                        </div>
                        <div class="row">
                            <div id="post-carousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#post-carousel" data-slide-to="1"></li>
                                  <li data-target="#post-carousel" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides, also where we need to inject picture paths--> 
                                <div class="carousel-inner">
                                  <div class="item active">
                                    <img src="images/4.jpg" alt="Los Angeles">
                                  </div>

                                  <div class="item">
                                    <img src="images/2.jpg" alt="Chicago">
                                  </div>

                                  <div class="item">
                                    <img src="images/3.jpg" alt="New york">
                                  </div>
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
<!--                        <p id="post-title-p"><b id="post-title"></b></p> -->
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
                
      <script>
          $(document).ready(function()
            {
                var postid = "<?php echo $postID?>"; //this postid is what will show up, just for testing purposes 
                var passed = 'getPostInfo';
                var type = 'get';
                var post;
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
            });
         </script>
    </body>
</html>