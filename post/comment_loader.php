<!-- Team Monday -->
<!-- comment_loader's purpose is to bring in the list of comments that a post may contain -->

<!-- things you put in this <body> will appear right where you call it in the page you decide to pull it from -->
<?php
function getHYPED($hype)
{
    echo $hype;
}
?>

<body> 
<div id = "comments_sec">
    <ul id="comment-list" class="list-unstyled"></ul>
</div>

<button type="button" id="showmore_b"> Show more </button>

</body>

<script> 

    var commsec = document.getElementById("comments_sec");
    var commentIterator = 0;    
    var postID = "<?php echo $postID;?>";
    $(document).ready(function()
    {
        // initial loading of comments (at most 2)
        
        getComment(postID, commentIterator);
        var c = 0;
        $("button#showmore_b").click(function()
        {
            commentIterator += 2; 
            getComment(postID, commentIterator);
            //ren(c++); //THIS IS CAUSING THE LINE TO SAY FAKE, it's just a thing to test out the adaptive IDs
        });

    }); 
    function ren(c)
    {
        document.getElementById("author"+c).innerHTML = "fake";
    }
    function getComment(postid, iterator)
    {
        var commentsJSON;

        var commsec = document.getElementById("comments_sec");
        var list = document.getElementById("comment-list");
        
        $.post('post/get_comments.php', {postid:postid, range:iterator}, function(data)
        {
            if(data != "false")
            {
                commentsJSON = JSON.parse(data);
                //no format file for this one, just focusing on the database yanking
                
               
                if(commentsJSON.length < 2) //balances the number
                    commentIterator--;
                
                for(var it = 0; it < commentsJSON.length; it++) //this is our format now T-T feelsbadman. Maybe a workaround some other time...
                {
                        var media = document.createElement("li");
                        media.setAttribute("class","media");
                            var img = document.createElement("img");
                            img.setAttribute("class","d-flex mr-3 pull-left comment-user-image");
                            img.setAttribute("src",commentsJSON[it].filepath);
                            var mediaBody = document.createElement("div");
                            mediaBody.setAttribute("class","media-body");
                                var a = document.createElement("a");//Author of comment
                                // a.setAttribute("id", comments[0].author); // unintended code, but a good observation on external ID definition
                                a.setAttribute("href", "#"); //this where we put the user in question.
                                a.setAttribute("id", "href"+(it+iterator));

                                var author = document.createElement("b");
                                author.setAttribute("id", "author"+(it+iterator));
                                author.innerHTML = commentsJSON[it].username;
                                a.appendChild(author);

                                var a2 = document.createElement("text"); //comment
                                a2.setAttribute("id","comment"+(it+iterator));
                                a2.innerHTML = commentsJSON[it].content;

                                var a3 = document.createElement("text"); 
                                a3.innerHTML = "Likes: ";

                                var a4 = document.createElement("b"); //actual likes value
                                a4.innerHTML = commentsJSON[it].likes+" ";
                                a4.setAttribute("id","likes"+(it+iterator));

                                var a5 = document.createElement("text"); //dislikes
                                a5.innerHTML = "Dislikes: ";

                                var a6 = document.createElement("b"); //actual dislike value
                                a6.innerHTML = commentsJSON[it].dislikes+" ";
                                a6.setAttribute("id","dislikes"+(it+iterator));
                                
                                var pLine = document.createElement("p");
                                pLine.setAttribute("id","line");
                    
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
                    media.appendChild(pLine);
                    commsec.appendChild(media);
                    //media.appendChild(document.createElement("br"));
                    list.appendChild(media);
                    // alert("id iterator current: " +(it+iterator)); //debug thing
                }
            }
            else
            {
                commentIterator -= 2;   
                // alert("Sorry, no more comments to load");
            } //this is just a bad way to do it. let's have it show directly on the webpage instead.
        });

        
    }
    function createDefaultComment()
    {
        var cs = document.getElementById("comments_sec");
        /* cs.innerHTML = "<a href = \"#\"><b id = \"authorDefault\"> Author </b></a>    <br/>    <text id = \"commentDefault\">My Comment lol.</text>    <br/>    <text>Likes: </text>    <b id = \"likesDefault\">3</b>    <text>Dislikes: </text>    <b id = \"dislikesDefault\">4</b>    <br/>    <br/>";*/ //this is jawot to the next level, no way this is the only solution
    }

    function getRemComment(postid, iterator)
    {
        var commentsJSON;
        $.post('post/get_comments.php', {postid:postid, range:iterator}, function(data)
        {
            commentsJSON = JSON.parse(data);
            //no format file for this one, just focusing on the database yanking
            var commsec = document.getElementById("comments_sec");

            for(var it = 0; it < commentsJSON.length; it++)
            {
                console.log("hope");
                var a = document.createElement("b");//Author of comment
            // a.setAttribute("id", comments[0].author); // unintended code, but a good observation on external ID definition
            a.innerHTML = commentsJSON[it].username;

            var a2 = document.createElement("a"); //Likes static text
            a2.innerHTML = "Likes: ";

            var a3 = document.createElement("b"); //actual likes value
            a3.innerHTML = commentsJSON[it].likes+" ";

            var a4 = document.createElement("a"); //dislikes
            a4.innerHTML = "Dislikes: ";

            var a5 = document.createElement("b"); //actual dislike value
            a5.innerHTML = commentsJSON[it].dislikes+" ";

            var a6 = document.createElement("p"); //the comment
            a6.innerHTML = commentsJSON[it].content;

            //adding to comments section
            commsec.appendChild(a);
            commsec.appendChild(a6);
            commsec.appendChild(a2);
            commsec.appendChild(a3);
            commsec.appendChild(a4);
            commsec.appendChild(a5);
            commsec.appendChild(document.createElement("br"));
            commsec.appendChild(document.createElement("br"));

            }
        });
    }
</script>


<!--
<script>
var comments = document.getElementById("comments");
var postID = "<?php echo $postID;?>";

// comments.innerHTML = postID;
 
var commentIterator = 0;    

    $(document).ready(function()
    {
        // initial loading of comments (at most 2)
        
        // getComment(postid, commentIterator);
        getComment2(postID, commentIterator);
        
        $("button#showmore_b").click(function()
        {
            commentIterator += 2; 
            getComment2(postID, commentIterator);
        });

    }); 

function getComment(postid, iterator)
{
    var commentsJSON;
    
    $.post('post/get_comments.php', {postid: postid, range: iterator, amount: 2}, function(data)
    {
        if(data != "false")
        {
            commentsJSON = JSON.parse(data);
            
           

        }
        else
        {
            alert("Sorry no more comments to load for this post");        
        }
    });
}

function getComment2(postid, iterator)
        {
            var commentsJSON;
            $.post('post/get_comments.php', {postid:postid, range:iterator, amount: 2}, function(data)
            {
                commentsJSON = JSON.parse(data);
                //no format file for this one, just focusing on the database yanking
                var commsec = document.getElementById("comments");
                var a = document.createElement("b");//Author of comment
                // a.setAttribute("id", comments[0].author); // unintended code, but a good observation on external ID definition
                a.innerHTML = commentsJSON[0].username;

                var a2 = document.createElement("a"); //Likes static text
                a2.innerHTML = "Likes: ";

                var a3 = document.createElement("b"); //actual likes value
                a3.innerHTML = commentsJSON[0].likes+" ";

                var a4 = document.createElement("a"); //dislikes
                a4.innerHTML = "Dislikes: ";

                var a5 = document.createElement("b"); //actual dislike value
                a5.innerHTML = commentsJSON[0].dislikes+" ";

                var a6 = document.createElement("p"); //the comment
                a6.innerHTML = commentsJSON[0].content;

                //adding to comments section
                commsec.appendChild(a);
                commsec.appendChild(a6);
                commsec.appendChild(a2);
                commsec.appendChild(a3);
                commsec.appendChild(a4);
                commsec.appendChild(a5);
                commsec.appendChild(document.createElement("br"));
                commsec.appendChild(document.createElement("br"));
               
              /*  if(comments.length < 1)// if ever there is more than one comment received
                {*/
                    //just a repeat above if ever there is more than one return
                    var b = document.createElement("b");
                    b.innerHTML = commentsJSON[1].username;
                    var b2 = document.createElement("a"); 
                    b2.innerHTML = "Likes: ";
                    var b3 = document.createElement("b"); 
                    b3.innerHTML = commentsJSON[1].likes+" ";
                    var b4 = document.createElement("a"); 
                    b4.innerHTML = "Dislikes: ";
                    var b5 = document.createElement("b");
                    b5.innerHTML = commentsJSON[1].dislikes+" ";
                    var b6 = document.createElement("p");
                    b6.innerHTML = commentsJSON[1].content;

                    commsec.appendChild(b);
                    commsec.appendChild(b6);
                    commsec.appendChild(b2);
                    commsec.appendChild(b3);
                    commsec.appendChild(b4);
                    commsec.appendChild(b5);
                    commsec.appendChild(document.createElement("br"));
                    commsec.appendChild(document.createElement("br"));
              // }

                // alert("Iteration: " +iterator);
            });
            
        }

</script>-->