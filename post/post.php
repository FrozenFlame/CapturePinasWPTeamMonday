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
      <div class="container-post">
        <div id ="postdiv">
            <div class="col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container">
                <div class="post">
                    <div class="row">
                        <!--<a href="#"><p><b id="post-name"></b></p></a> -->
                    <p id="post-title-p"><h4><b id="post-title"></b></h4></p>
                           
                           
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
                     
                        <div class="media">
                            <img class="d-flex mr-3 post-user-image pull-left" src="/CapturePinasWPTeamMonday/images/userimages/default.png" id= "user-image"/>
                            <div class="media-body">
                                <a href="#" id="post-href">
                                    <p class="post-username">
                                        <b id ="post-username"></b>
                                    </p>
                                </a>
                                <p class="post-place">
                                    <text>in </text>
                                    <b id="post-place">Place</b>
                                </p>
                                <p id="post-timestamp">Date</p>
                            </div>
                        </div>
                        <p class="post-description" id="post-description"></p>
                        <p id="line"></p> 
                        <button class="btn btn-default" type="button" id="post-like-btn" onclick = "thumbsUp(this)">
                            <text id = "post-likes">0</text> 
                            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                            <text> Likes </text>
                        </button>
                        <button class="btn btn-default" type="button" id="post-unlike-btn" onclick = "thumbsDown(this)">
                            <text id = "post-dislikes">0</text>  
                            <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                            <text> Disikes </text>
                        </button>
                        <p id="line"></p>

                        <!-- Comments Section -->
                        <b> Comments </b>
                        <br/>
                        <div class="textarea-div">
                            <textarea class="form-control" id="post-comment" placeholder="Enter a comment.."></textarea>
                            <button type="button" class="btn btn-default" id="textarea-button" >Comment</button>
                        </div>
                        <!-- <p id="line"></p> -->
                        <!-- passing postID value to comment loader -->
                        <?php include("comment_loader.php"); ?>
                    </div>
                    
                </div>
            </div>
        </div>
      </div>
        
                
      <script>
            var loggedUsername;
            var postid = "<?php echo $postID ?>"; //this postid is what will show up, just for testing purposes
            var isGuest = "<?php echo $isGuest; ?>";
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
                            var hrf = document.getElementById("post-href");
                            hrf.setAttribute("onclick","goToProfile(this)");
                            hrf.setAttribute("data-userid", userid);
                        }); 
                        document.getElementById("user-image").setAttribute("src", post[0].filepath);
                        $('b#post-place').text(post[0].place);
                            /**
                        * TIME CALCULATION 
                        */
                        function formatDateHTML(date) 
                        {
                            var months = 
                            [
                                "January", "February", "March",
                                "April", "May", "June", "July",
                                "August", "September", "October",
                                "November", "December"
                            ];

                            var day = date.getDate();
                            var monthIndex = date.getMonth();
                            var year = date.getFullYear();

                            var hour = date.getHours();
                            var min = date.getMinutes();

                            function FormatNumberLength(num, length) 
                            {
                                var r = num.toString();
                                while (r.length < length) 
                                {
                                    r = "0" + r;
                                }
                                return r;
                            }

                            return "[" +FormatNumberLength(hour,2) +":" +FormatNumberLength(min,2)+"] " +day + " " + months[monthIndex] + ", " + year;
                        }
                        function formatDateStr(date) //returns a string for the Date() object
                        {
                            // 2016-08-15 17:56:23 ex.
                            var dateParts = date.split("-");
                            var months = 
                            [
                                "Jan", "Feb", "Mar",
                                "Apr", "May", "Jun", "Jul",
                                "Aug", "Sep", "Oct",
                                "Nov", "Dec"
                            ];
                            

                            var day = dateParts[2].substr(0,2);
                            var monthIndex = parseInt(dateParts[1])-1;
                            var year = dateParts[0];

                            // var hour = dateParts[2].substr(3,5);
                            // var min = dateParts[2].substr(6,8);
                            // var sec = dateParts[2].substr(9,11);
                            var time = dateParts[2].substr(3,11);

                            return months[monthIndex] +" " +day +" " +year +" " +time +" GMT+0800 (Taipei Standard Time)" ;
                        }
                        var sqlTimestamp = post[0].timestamp;
                        var str = formatDateStr(sqlTimestamp);
                        
                        var currentDate = new Date();
                        var postDate = new Date(str);
                        var jsDate = formatDateHTML(new Date(str));
                        var diffTime = getTimeDiff(currentDate, postDate);
                        var timeString = jsDate +" " +diffTime;
                        
                        console.log(jsDate);
                        /**
                        * end of algorithm
                        */
                        $('p#post-timestamp').text(timeString);
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

                    // $("#post-like-btn").click(function()
                    // {
                    //     var likes = parseInt($(this).text());
                    //     $(this).text(likes+1+' ');
                    //     $(this).append('<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>');
                    // });

                    // $("#post-unlike-btn").click(function()
                    // {
                    //     var likes = parseInt($(this).text());
                    //     $(this).text(likes+1+' ');
                    //     $(this).append('<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>');
                    // });

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
                            img.setAttribute("class","d-flex mr-3 pull-left comment-user-image");
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

                                

                                var a3b = document.createElement("button");
                                a3b.setAttribute("type", "button");
                                a3b.setAttribute("class", "btn btn-default");
                                var commentind = document.getElementById('comment-list').children.length;//(document.getElementById('comment-list').children.length) is to get the amount of comments and apply it here
                                a3b.setAttribute("id", "comment-like-btn"+commentind); 
                                a3b.setAttribute("onclick","thumbsUpComment(this)");
                                    var a3btext = document.createElement("text");
                                    a3btext.setAttribute("id","comment-likes");
                                    // a3btext.setAttribute("data-commentid", cid+"");//cid will now be applied later in the code.
                                    a3btext.innerHTML = 0 +" ";
                                    var a3bspan = document.createElement("span");
                                    a3bspan.setAttribute("class", "glyphicon glyphicon-thumbs-up");
                                    a3bspan.setAttribute("aria-hidden","true");
                                a3b.appendChild(a3btext);
                                a3b.appendChild(a3bspan);
                                
                                var a4b = document.createElement("button");
                                a4b.setAttribute("type", "button");
                                a4b.setAttribute("class", "btn btn-default");
                                a4b.setAttribute("id", "comment-dislike-btn"+commentind);
                                a4b.setAttribute("onclick","thumbsDownComment(this)");
                                var a4btext = document.createElement("text");
                                a4btext.setAttribute("id","comment-dislikes");
                                // a4btext.setAttribute("data-commentid", cid); //cid will now be applied later in the code.
                                a4btext.innerHTML = 0 +" ";
                                var a4bspan = document.createElement("span");
                                a4bspan.setAttribute("class", "glyphicon glyphicon-thumbs-down");
                                a4bspan.setAttribute("aria-hidden","true");
                                a4b.appendChild(a4btext);
                                a4b.appendChild(a4bspan);
                                /*var a4 = document.createElement("b"); //actual likes value
                                a4.innerHTML = 0 +" ";
                                a4.setAttribute("id","likes"+(commentIterator+1));

                                var a5 = document.createElement("text"); //dislikes
                                a5.innerHTML = "Dislikes: ";

                                var a6 = document.createElement("b"); //actual dislike value
                                a6.innerHTML = 0 +" ";
                                a6.setAttribute("id","dislikes"+(commentIterator+1));*/
                                
                                var pLine = document.createElement("p");
                                pLine.setAttribute("id","line");

                    //adding to comments section
                    media.appendChild(img);
                    mediaBody.appendChild(a);
                    mediaBody.appendChild(document.createElement("br"));
                    mediaBody.appendChild(a2);
                    mediaBody.appendChild(document.createElement("br"));
                    mediaBody.appendChild(a3b);
                    var space = document.createElement("text");
                    space.innerHTML = " ";
                    mediaBody.appendChild(space);
                    mediaBody.appendChild(a4b);
                    // mediaBody.appendChild(a4);
                    // mediaBody.appendChild(a5);
                    // mediaBody.appendChild(a6);
                    media.appendChild(mediaBody);
                    media.appendChild(pLine);
                    commsec.appendChild(media);
                    list.appendChild(media);

                    var cid; //data-commentid application
                    $.post('ajax/db_dealer.php', {type:"get", command:"getLastCommentId"}, function(data)
                    {
                        cid = data;
                        a3btext.setAttribute("data-commentid", cid);
                        a4btext.setAttribute("data-commentid", cid);
                    });
                            
                        });
                    }, 800);
                }
                else
                {
                  
                }
                
               
            }



            //thumbs up and down
            function thumbsUp(elem)   //for post @param elem is the button itself
            {
                if(!isGuest)
                {
                    // alert(id.id);
                    var postRating = elem.children[0]; //element that contains our like post rating
                    var thumbdownelem = document.getElementById('post-dislikes');

                    $.post('ajax/db_dealer.php', {type: "get", command: "postOpinion", postid: postid}, function(data) //we expect data to be: L, D, or N
                    {
                        // alert(data +" prev opinion");
                        switch(data)
                        {
                            case 'N'://Neutral  (+1 for like)                   -> db value is now L
                                postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                                givePostOpinion(postid, "L");
                            break;
                            case 'L'://Liked    (-1 for like)                   -> db value is now N
                                postRating.innerHTML = parseInt(postRating.innerHTML) -1 +" ";
                                givePostOpinion(postid, "N");
                            break;
                            case 'D'://Disliked (+1 for like, -1 for dislike)   -> db value is now L
                                postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                                thumbdownelem.innerHTML = parseInt(thumbdownelem.innerHTML) -1 +" ";
                                givePostOpinion(postid, "L");
                            break;
                        }
                    }); 
                    //cooldown
                    elem.disabled = true;
                    setTimeout(function()
                    {
                        elem.disabled = false;
                    },1000);
                }
                else
                    alert("You must be logged in to perform that action.");
                

            }
            function thumbsDown(elem) //for post @param elem is the button itself
            {
                if(!isGuest)
                {
                    // alert(id);
                    var postRating = elem.children[0]; //element that contains our dislike post rating
                    var thumbupelem = document.getElementById('post-likes');

                    $.post('ajax/db_dealer.php', {type:"get", command:"postOpinion", postid: postid}, function(data) //we expect data to be: L, D, or N
                    {
                        switch(data)
                        {
                            case 'N'://Neutral  (+1 for dislike)                -> db value is now D
                                postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                                givePostOpinion(postid, "D");
                            break;
                            case 'L'://Liked    (+1 for dislike, -1 for like)   -> db value is now D
                                postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                                thumbupelem.innerHTML = parseInt(thumbupelem.innerHTML) -1 +" ";
                                givePostOpinion(postid, "D");
                            break;
                            case 'D'://Disliked (-1 for dislike)                -> db value is now N
                                postRating.innerHTML = parseInt(postRating.innerHTML) -1 +" ";
                                givePostOpinion(postid, "N");
                            break;
                        }
                    });
                    //cooldown
                    elem.disabled = true;
                    setTimeout(function()
                    {
                        elem.disabled = false;
                    },1000);
                }
                else
                    alert("You must be logged in to perform that action.");
                

            }
            function givePostOpinion(postid, opinion)
            {
                $.post('ajax/db_dealer.php', {type: "set", command: "postOpinion", postid: postid, opinion: opinion});
            }
            function getTimeDiff(curDate, posDate) //returns a string of the time difference
            {
                /**
                * milliseconds to other time:
                * 1 sec = 1000ms
                * 1 min = 60000ms
                * 1 hr = 3.6e+6ms
                * 1 day = 8.64e+7ms
                * 1 week = 6.048e+8ms
                * 1 month = 2.628e+9ms
                * 1 year = 3.154e+10
                */
                var diff="";
                
                var unixDiff = Math.abs(curDate.getTime() - posDate.getTime());

                if(unixDiff < 60000) //post is just a few seconds old
                {
                    var grammar = (Math.ceil(unixDiff/(1000)) > 1) ? "seconds": "second";
                    var diff = Math.ceil(unixDiff / (1000))+ " seconds";
                }
                else if(unixDiff < 3.6e+6) //post is less than an hour old
                {
                    var grammar = (Math.ceil(unixDiff/(1000 * 60)) > 1) ? " minutes": " minute";
                    var diff = Math.ceil(unixDiff/(1000 * 60)) +grammar;
                }
                else if(unixDiff < 8.64e+7) //post is less than a day old
                {
                    var grammar = (Math.ceil(unixDiff/(1000 * 60 * 60)) > 1) ? " hours": " hour";
                    var diff = Math.ceil(unixDiff/(1000 * 60 * 60)) +grammar;
                }
                else if(unixDiff < 6.048e+8) //post is less than a week old
                {
                    var grammar = (Math.ceil(unixDiff/(1000 * 60 * 60 * 24)) > 1) ? " days": " day";
                    var diff = Math.ceil(unixDiff/(1000 * 60 * 60 * 24)) +grammar;
                }
                else if(unixDiff < 2.628e+9) //post is less than a month old
                {
                    var grammar = (Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 7)) > 1) ? " weeks": " week";
                    var diff = Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 7)) +grammar;
                }
                else if(unixDiff < 3.154e+10) //post is less than a year old
                {                                                            //lol hax using days instead of weeks       
                    var grammar = (Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 30 )) > 1) ? " months": " month";
                    var diff = Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 30 )) +grammar;
                }
                else //years old ._. 
                {
                    var grammar = (Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 7 * 4 * 12)) > 1) ? " years": " year";
                    var diff = Math.ceil(unixDiff/(1000 * 60 * 60 * 24 * 7 * 4 * 12)) +grammar;
                }
                    
                return "(about " +diff +" ago)";
            }   
            function goToProfile(elem)
            {
                var form = document.createElement('form');  
                form.method = 'post';
                form.action = 'user-profile.php';
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'userid';
                input.value = elem.dataset.userid;
                form.appendChild(input);
                document.body.appendChild(form);

                form.submit();
                // $.post('user_profile.php', {userid: elem.dataset.userid});
            }
         </script>
    </body>
</html>