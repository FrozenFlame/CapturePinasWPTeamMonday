<html>
  <head>
    <title>CapturePinas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css"> <!-- changed to local files -->
    <script src = "js/jquery-3.2.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/home-in.css" rel="stylesheet">

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
                            <a href="#"><p><b>Reymark Arsenio</b></p></a>
                        </div>
                        <div class="row">
                            <div id="post-carousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#post-carousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#post-carousel" data-slide-to="1"></li>
                                  <li data-target="#post-carousel" data-slide-to="2"></li>
                                </ol>

                                <!-- Wrapper for slides -->
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
                            <p><b>Its more funner in Bolinao! </b> <br>Bolinao, Pangasinan <br>10:51pm September 31, 2017</p>
                            <p id="post-description">This place is very wonderful. Astig grabe ayoko nang bumalik dito! Sana di na ko pumunta
                            kasi sobrang ganda talaga. Worth the pagod beshies punta na kayo dyan huhu</p>
                            <p id="line"></p>
                            <button class="btn btn-default" type="button" id="post-like-btn">0 <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
                            <button class="btn btn-default" type="button" id="post-unlike-btn">0 <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
                            <p id="line"></p>
                            <div class="textarea-div">
                                <textarea class="form-control" id="post-comment" placeholder="Enter a comment.."></textarea>
                                <button type="button" class="btn btn-default" id="textarea-button" >Comment</button>
                            </div>

                        </div>
                    </div>
                </div>
      <script>
          $(document).ready(function()
            {
                /*var passed = 'getPostImages';
              
                $.post('ajax/set.php', {passed: passed}, function(data)  //user is what we're passing in, and usern is what php will reference it with.
                {
                    alert(data);
                
                  $('a#nav_name_user').text(data+' ');
                $('a#nav_name_user').append('<span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"></span>');
                }); */ 
                $("#post-like-btn").click(function()
                {
                    var likes = parseInt($(this).text());
                    $(this).text(likes+1+' ');
                    $(this).append('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>');
                })
                $("#post-unlike-btn").click(function()
                {
                    var likes = parseInt($(this).text());
                    $(this).text(likes+1+' ');
                    $(this).append('<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>');
                })
            });
         </script>
    </body>
</html>