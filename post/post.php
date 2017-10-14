<!-- 
  Made By Jarvis
  This page is what happens if you select a specific post to show.
-->
<?php
  #variable declaration
  $hype = "HYYYYPE"; # THIS IS IT
   #just a test, the value we put here should come from the post that was selected, which will have its own logic some other time
?>

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
                     
                        <div class="media"><img class="d-flex mr-3 post-user-image pull-left" src="/CapturePinasWPTeamMonday/images/userimages/default.png" id= "user-image"/><div class="media-body"><a href="#" id="post-href"><p><b class="post-username" id ="post-username"></b></p></a><p><text>in </text><b id="post-place">Place</b></p><p id="post-timestamp">Date</p></div></div>
                        <p id="post-description"></p>
                        <p id="line"></p> 
                        <button class="btn btn-default" type="button" id="post-like-btn"><text id = "post-likes">0</text> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span></button>
                        <button class="btn btn-default" type="button" id="post-unlike-btn">
                            <text id = "post-dislikes">0</text>  
                            <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span></button>
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
            var loggedUsername;
            var postid = "<?php echo $postID ?>"; //this postid is what will show up, just for testing purposes
          
          $(document).ready(function()
            {
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
                            $('b#post-username').text(data);
                        }); 
                        document.getElementById("user-image").setAttribute("src", post[0].filepath);
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

                    //comment button
                    $("#textarea-button").click(function()
                    {
                        if(document.getElementById("post-comment").value.trim() != '')
                        {
                            revealAllComments();//displays all comments      
                            var elem = document.getElementById("post-comment");  
                            postComment(elem.value, postid);                
                            elem.value = '';
                            
                            //comment cooldown
                            document.getElementById("textarea-button").disabled = true;
                            setTimeout(function()
                            {
                                document.getElementById("textarea-button").disabled = false;
                            }, 5000);
                        }
                        else
                        {
                            alert("Please fill the comment box before submitting your comment.");
                            document.getElementById("post-comment").value = '';
                        }
                       
                    });

                    //prepares username
                    $.post('ajax/db_dealer.php', {type: "get", command: "getPostAuthor", author_id: "<?php echo $_SESSION['id']; ?>"}, function(data)
                    {
                       loggedUsername = data;
                    });

                }
                else
                {
                    document.getElementById("postdiv").innerHTML = "<h1>Sorry! This post does not exist!</h1>";
                    document.getElementById("postdiv").innerHTML += "<br/><h2> Redirecting in <b id=\"redirect\">5</b></h2>" 
                    var timeLeft = 4;
                    var countdown = setInterval(function()
                    {
                        document.getElementById("redirect").innerHTML = timeLeft--;
                    }, 1000);
                    setTimeout(function () 
                    {
                        clearInterval(countdown);
                        window.location.href = "index.php"; //will redirect to your blog page (an ex: blog.html)
                    }, 5000); //will call the function after 2 secs.
                }
                
            });

            function revealAllComments()
            {
                // alert("fale");
                // getRemComment(postid, iterator);
                for(var iter = 0; iter < 33; iter++) //sad brute force way to do this
                {
                    commentIterator += 2;
                    getComment(postid, commentIterator);
                }
                // commentIterator = document.getElementById("comments_sec").children.length;
                commentIterator++;

            }
            function postComment(comment, postID)
            {
                // alert(comment);  
                //delay gaming for arrangement purposes
                if(comment.trim() != '')
                {
                    setTimeout( function()
                    {
                        var comment_ = new Object();
                        comment_.postid = postID;
                        comment_.userid = "<?php echo $_SESSION['id']; ?>";
                        comment_.content = comment;
                        var commentJSON =  JSON.stringify(comment_);
                        // alert("post.php says: " +commentJSON);
                        $.post('ajax/db_dealer.php', {type:"set", command:"postComment", comment: commentJSON, userid: comment_.userid}, function(filepath)
                        {
                            var list = document.getElementById("comment-list");
                            
                            var media = document.createElement("li");
                            media.setAttribute("class","media");
                            var img = document.createElement("img");
                            img.setAttribute("class","d-flex mr-3 pull-left post-user-image");
                            img.setAttribute("src",filepath);
                            var mediaBody = document.createElement("div");
                            mediaBody.setAttribute("class","media-body");
    
                                var a = document.createElement("a");//Author of comment
                                a.setAttribute("href", "#"); //this where we put the user in question.
                                a.setAttribute("id", "href"+(commentIterator+1));

                                var author = document.createElement("b");
                                author.setAttribute("id", "author"+(commentIterator+1));

                                author.innerHTML = loggedUsername;
                                a.appendChild(author);

                                var a2 = document.createElement("text"); //comment
                                a2.setAttribute("id","comment"+(commentIterator+1));
                                a2.innerHTML = comment;

                                var a3 = document.createElement("text"); 
                                a3.innerHTML = "Likes: ";

                                var a4 = document.createElement("b"); //actual likes value
                                a4.innerHTML = 0 +" ";
                                a4.setAttribute("id","likes"+(commentIterator+1));

                                var a5 = document.createElement("text"); //dislikes
                                a5.innerHTML = "Dislikes: ";

                                var a6 = document.createElement("b"); //actual dislike value
                                a6.innerHTML = 0 +" ";
                                a6.setAttribute("id","dislikes"+(commentIterator+1));
                    
                    //adding to comments section
                    media.appendChild(img);
                    mediaBody.appendChild(a);
                    mediaBody.appendChild(document.createElement("br"));
                    mediaBody.appendChild(a2);
                    mediaBody.appendChild(document.createElement("br"));
                    mediaBody.appendChild(a3);
                    mediaBody.appendChild(a4);
                    mediaBody.appendChild(a5);
                    mediaBody.appendChild(a6);
                    media.appendChild(mediaBody);
                    commsec.appendChild(media);
                    media.appendChild(document.createElement("br"));
                    list.appendChild(media);
                            
                            //|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
                            
                            /*alert(filepath);
                            var commsec = document.getElementById("comments_sec");
                            var a = document.createElement("a");//Author of comment
                            a.setAttribute("href", "#"); //this where we put the user in question.
                            a.setAttribute("id", "href"+(commentIterator+1));

                            var author = document.createElement("b");
                            author.setAttribute("id", "author"+(commentIterator+1));

                            author.innerHTML = loggedUsername;
                            a.appendChild(author);

                            var a2 = document.createElement("text"); //comment
                            a2.setAttribute("id","comment"+(commentIterator+1));
                            a2.innerHTML = comment;

                            var a3 = document.createElement("text"); 
                            a3.innerHTML = "Likes: ";

                            var a4 = document.createElement("b"); //actual likes value
                            a4.innerHTML = 0 +" ";
                            a4.setAttribute("id","likes"+(commentIterator+1));

                            var a5 = document.createElement("text"); //dislikes
                            a5.innerHTML = "Dislikes: ";

                            var a6 = document.createElement("b"); //actual dislike value
                            a6.innerHTML = 0 +" ";
                            a6.setAttribute("id","dislikes"+(commentIterator+1));

                            commsec.appendChild(a);
                            commsec.appendChild(document.createElement("br"));
                            commsec.appendChild(a2);
                            commsec.appendChild(document.createElement("br"));
                            commsec.appendChild(a3);
                            commsec.appendChild(a4);
                            commsec.appendChild(a5);
                            commsec.appendChild(a6);
                            commsec.appendChild(document.createElement("br"));
                            commsec.appendChild(document.createElement("br"));*/
                        });
                    }, 800);
                }
                else
                {
                  
                }
                
               
            }
         </script>
    </body>
</html>