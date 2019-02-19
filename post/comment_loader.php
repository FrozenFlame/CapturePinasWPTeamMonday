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
                                a.setAttribute("onclick", "goToProfile(this)");
                                a.setAttribute("data-userid", commentsJSON[it].userid);
                                var author = document.createElement("b");
                                author.setAttribute("id", "author"+(it+iterator));
                                author.innerHTML = commentsJSON[it].username;
                                a.appendChild(author);
                                var a2 = document.createElement("text"); //comment
                                a2.setAttribute("id","comment"+(it+iterator));
                                a2.innerHTML = commentsJSON[it].content;
                              
                                //yo learned something, adding 'data-' before your attempt at a custom tag attribute allows the document to remain in valid status. this is a new HTML 5 thing.
                                var a3b = document.createElement("button");
                                a3b.setAttribute("type", "button");
                                a3b.setAttribute("class", "btn btn-default");
                                a3b.setAttribute("id", "comment-like-btn" +(it+iterator));
                                a3b.setAttribute("onclick","thumbsUpComment(this)");
                                    var a3btext = document.createElement("text");
                                    a3btext.setAttribute("id","comment-likes" );
                                    a3btext.setAttribute("data-commentid", commentsJSON[it].commentid);//this is now commentid
                                    a3btext.innerHTML = commentsJSON[it].likes +" ";
                                    var a3bspan = document.createElement("span");
                                    a3bspan.setAttribute("class", "glyphicon glyphicon-thumbs-up");
                                    a3bspan.setAttribute("aria-hidden","true");
                                a3b.appendChild(a3btext);
                                a3b.appendChild(a3bspan);
                               
                                var a4b = document.createElement("button");
                                a4b.setAttribute("type", "button");
                                a4b.setAttribute("class", "btn btn-default");
                                a4b.setAttribute("id", "comment-dislike-btn" +(it+iterator));
                                a4b.setAttribute("onclick","thumbsDownComment(this)");
                                    var a4btext = document.createElement("text");
                                    a4btext.setAttribute("id","post-dislikes");
                                    a4btext.setAttribute("data-commentid", commentsJSON[it].commentid);//this is now commentid
                                    a4btext.innerHTML = commentsJSON[it].dislikes +" ";
                                    var a4bspan = document.createElement("span");
                                    a4bspan.setAttribute("class", "glyphicon glyphicon-thumbs-down");
                                    a4bspan.setAttribute("aria-hidden","true");
                                a4b.appendChild(a4btext);
                                a4b.appendChild(a4bspan);
                              
                                
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
                    media.appendChild(mediaBody);
                    media.appendChild(pLine);
                    commsec.appendChild(media);
                    list.appendChild(media);
                    setLikesDislikesComment(commentsJSON[it].commentid,it,iterator);
                }
            }
            else
            {
                commentIterator -= 2;   
            } 
        });
       
        
    }
    function createDefaultComment()
    {
        var cs = document.getElementById("comments_sec");
    }
    function setLikesDislikesComment(cid, it,index)
    {
        var likebtn = '#comment-like-btn'+(it+index);
        var unlikebtn = '#comment-dislike-btn'+(it+index);
        $.post('ajax/db_dealer.php', {type: "get", command: "commentOpinion", commentid: cid}, function(data) //we expect data to be: L, D, or N
        {
            switch(data)
            {
                case 'N'://Neutral  (+1 for like)                   -> db value is now L
                    $(likebtn).attr("style","background-color:white;");
                    $(unlikebtn).attr("style","background-color:white;");
                break;
                case 'L'://Liked    (-1 for like)                   -> db value is now N
                    $(likebtn).attr("style","background-color:#6ec62b;color:white;");
                break;
                case 'D'://Disliked (+1 for like, -1 for dislike)   -> db value is now L
                    $(unlikebtn).attr("style","background-color:#f44141;color:white;");
                break;
            }
        }); 
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

