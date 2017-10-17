// Team Monday

/***********************************************************************
 *  Post design by       : @author Jarvis 
 *  Conversion to DOM by : @author DD_
 *  13-OCT-17
 ***********************************************************************/

/**
 * @param {element} container - This is the html element you wish to insert the content into.
 * @param {string} json - The data you wish to insert must be in a JSON STRING format.
 * @param {int} index - The index for the unique id acquisition.
 */
var postJSON;
var _userid = "<?php echo $_SESSION['id']; ?>";
var isGuest = "<?php echo $isGuest; ?>";

function createPostLite(container, json, index)
{
    // setting of JSON content will be synced
    postJSON = JSON.parse(json);
    
    var jsonlength;
    (postJSON.length == null)? jsonlength = 0:jsonlength = postJSON.length;
    off -= (4-jsonlength); //this keeps our function ready for any new database entries on the fly. Ajax gaming.
    
    //basically, every item here needs to have some kind of naming convention attached to them + the uniqueID
    // might need some algorithm in separate functions for this, for variable length things like images uploaded
    //OKAY, while working it stumbled in my mind that maybe we don't needto give a unique ID to EVERYTHING after all
    for(var it = 0; it < postJSON.length; it++) 
    {
        var outerDiv = document.createElement("div"); // main container of an individual post_lite
        outerDiv.setAttribute("class", "class=\"col-lg-offset-2 col-md-offset-2 col-offset-xs-0 col-md-8 col-sm-12 post-container\"");

        var postDiv = document.createElement("div"); // post class
        postDiv.setAttribute("class", "post");
        //going to package this into outerdiv later for clarity

        /*ROWS*/
        var rowTitle = document.createElement("div");
        rowTitle.setAttribute("class", "row");
        var rowCarousel = document.createElement("div");
        rowCarousel.setAttribute("class", "row");
        var rowDetails = document.createElement("div");
        rowDetails.setAttribute("class", "row");
        postDiv.appendChild(rowTitle);
        postDiv.appendChild(rowCarousel);
        postDiv.appendChild(rowDetails);

        /*ROW CONTENTS*/
        //rowTitle
        var pTitle = document.createElement("a"); //changed to 'a'
        pTitle.setAttribute("href", "post_page.php?post="+postJSON[it].postid);       
        pTitle.setAttribute("id", "post-title-p"+it+index);
        pTitle.setAttribute("class", "post-title");
        var bTitle = document.createElement("b");
        
        // bTitle.innerHTML = "Title"; //TODO: tempData
        bTitle.innerHTML = postJSON[it].title;
        pTitle.appendChild(bTitle);
        rowTitle.appendChild(pTitle);

        //rowCarousel
        var divCarousel = document.createElement("div");
        divCarousel.setAttribute("id","post-carousel"+it+index);
        divCarousel.setAttribute("class","carousel slide");
        divCarousel.setAttribute("data-ride", "carousel");
        /*rowCarousel-children*/
            //olCarousel
            var olCarousel = document.createElement("ol");//THIS WILL NEED AN ALGORITHM FOR VARYING PICTURE AMOUNTS 
            olCarousel.setAttribute("class","carousel-indicators");
                /*olCarousel-children*/
                //THIS IS WHERE YOU NEED TO ITERATE
                var liCar = [];
                for(var i = 0; i < postJSON[it].path.length; i++)
                {
                    var li = document.createElement("li");
                    li.setAttribute("data-target","#post-carousel"+it+index);
                    li.setAttribute("data-slide-to", i);
                    // if(i == 0)
                    //     li.setAttribute("class","active");
                    liCar.push(li);
                    olCarousel.appendChild(liCar[i]);
                }
                liCar[0].setAttribute("class","active");
            //divCarouselInner
            var divCarouselInner = document.createElement("div");
            divCarouselInner.setAttribute("class","carousel-inner");
                /*divCarouselInner-children*/
                //divItemActive
                var divItem = [];
                for(var i = 0; i < liCar.length; i++)
                {
                    var item = document.createElement("div");
                    item.setAttribute("class","item");
                    var img = document.createElement("img");
                    img.setAttribute("src", postJSON[it].path[i]);
                    img.setAttribute("alt","Image not found");
                    item.appendChild(img);
                    divItem.push(item);
                    divCarouselInner.appendChild(divItem[i]);
                }
                divItem[0].setAttribute("class","item active");
              
            //aLeftControl
            var aLeftControl = document.createElement("a");
            aLeftControl.setAttribute("class","left carousel-control");
            aLeftControl.setAttribute("href","#post-carousel"+it+index);
            aLeftControl.setAttribute("data-slide", "prev");
                /*aLeftControl-children*/
                var spanGlyphLeft = document.createElement("span");
                spanGlyphLeft.setAttribute("class","glyphicon glyphicon-chevron-left");
                var spanSrOnlyLeft = document.createElement("span");
                spanSrOnlyLeft.setAttribute("class","sr-only");
                spanSrOnlyLeft.innerHTML = "Previous";
                aLeftControl.appendChild(spanGlyphLeft);
                aLeftControl.appendChild(spanSrOnlyLeft);
            //aRightControl
            var aRightControl = document.createElement("a");
            aRightControl.setAttribute("class","right carousel-control");
            aRightControl.setAttribute("href","#post-carousel"+it+index);
            aRightControl.setAttribute("data-slide", "next");
                /*aRightControl-children*/
                var spanGlyphRight = document.createElement("span");
                spanGlyphRight.setAttribute("class","glyphicon glyphicon-chevron-right");
                var spanSrOnlyRight = document.createElement("span");
                spanSrOnlyRight.setAttribute("class","sr-only");
                spanSrOnlyRight.innerHTML = "Next";
                aRightControl.appendChild(spanGlyphRight);
                aRightControl.appendChild(spanSrOnlyRight);
            //placing all children back into divCarousel (from row)
            divCarousel.appendChild(olCarousel);
            divCarousel.appendChild(divCarouselInner);
            divCarousel.appendChild(aRightControl);
            divCarousel.appendChild(aLeftControl);
        rowCarousel.appendChild(divCarousel);
        //rowDetails
        // var divDetails = document.createElement("div");
        // divDetails.setAttribute("class","row");
            /*divDetails-children*/
            
        
            //post-media
            var divMedia = document.createElement("div");
            divMedia.setAttribute("class","media");
                //image of the user
                var imgMedia = document.createElement("img");
                imgMedia.setAttribute("class","d-flex mr-3 post-user-image pull-left");
                imgMedia.setAttribute("src", postJSON[it].filepath);
                //media body
                var divMediaBody = document.createElement("div");
                divMediaBody.setAttribute("class","media-body");
                    //post name
                    var aPostName = document.createElement("a"); //author of the post
                    aPostName.setAttribute("href", "#"); //painful... this needs yet another algorithm
                    aPostName.setAttribute("id","post-href");
                    aPostName.setAttribute("data-userid", postJSON[it].userid);
                    aPostName.setAttribute("onclick", "goToProfile(this)");
                    /*aPostName-children*/
                    var pPostName = document.createElement("p");
                    pPostName.setAttribute("class","post-username");
                    var bPostName = document.createElement("b");
                    
                    bPostName.innerHTML = postJSON[it].username;
                    pPostName.appendChild(bPostName);
                    aPostName.appendChild(pPostName);
                    //pPostPlace
                    var pPostPlace = document.createElement("p");
                    pPostPlace.setAttribute("class","post-place");
                    /*pPostPlace-children*/
                    var text = document.createElement("text");
                    text.innerHTML = "in ";
                    var bPostPlace = document.createElement("b");
                    bPostPlace.innerHTML = postJSON[it].place;
                    pPostPlace.appendChild(text);
                    pPostPlace.appendChild(bPostPlace);
                    //pPostTimeStamp
                    var pPostTimeStamp = document.createElement("p");
                    pPostTimeStamp.setAttribute("id","post-timestamp");

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
                    var sqlTimestamp = postJSON[it].timestamp;
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
                    pPostTimeStamp.innerHTML = timeString;
        divMediaBody.appendChild(aPostName);
        divMediaBody.appendChild(pPostPlace);
        divMediaBody.appendChild(pPostTimeStamp);
        divMedia.appendChild(imgMedia);
        divMedia.appendChild(divMediaBody);

            //pPostDescription
            var pPostDescription = document.createElement("p");
            pPostDescription.setAttribute("class","post-description");
            pPostDescription.innerHTML = postJSON[it].description;
            //line
            var pLine = document.createElement("p");
            pLine.setAttribute("id","line");
            /*post like dislike buttons*/
            //like
        
            var buttonLike = document.createElement("button");
            buttonLike.setAttribute("class","btn btn-default post-like-button");
            buttonLike.setAttribute("type","button");
            buttonLike.setAttribute("id","post-like-btn"+(it+index));
            buttonLike.setAttribute("data-postid",postJSON[it].postid);
            buttonLike.setAttribute("onclick","thumbsUp(this)");
                /*buttonLike-children*/
                var buttonTextLike = document.createElement("text");
                buttonTextLike.setAttribute("id","post-likes"+(it+index));
                buttonTextLike.innerHTML = postJSON[it].likes +" ";
                var spanLike = document.createElement("span");
                spanLike.setAttribute("class","glyphicon glyphicon-thumbs-up");
                spanLike.setAttribute("aria-hidden","true");
            buttonLike.appendChild(buttonTextLike);
            buttonLike.appendChild(spanLike);
            //dislike
            var buttonDislike = document.createElement("button");
            buttonDislike.setAttribute("class","btn btn-default post-dislike-button");
            buttonDislike.setAttribute("type","button");
            buttonDislike.setAttribute("id","post-unlike-btn"+(it+index)); //@Jarvis. Unlike hahahaha
            buttonDislike.setAttribute("data-postid", postJSON[it].postid);
            buttonDislike.setAttribute("onclick","thumbsDown(this)");
                /*buttonLike-children*/
                var buttonTextDislike = document.createElement("text");
                buttonTextDislike.setAttribute("id","post-dislikes"+(it+index));
                buttonTextDislike.innerHTML = postJSON[it].dislikes +" "; //0 is default value, replace this with JSON value
                var spanDislike = document.createElement("span");
                spanDislike.setAttribute("class","glyphicon glyphicon-thumbs-down");
                spanDislike.setAttribute("aria-hidden","true");
            buttonDislike.appendChild(buttonTextDislike);
            buttonDislike.appendChild(spanDislike);
            var pLine2 = document.createElement("p");
            pLine2.setAttribute("id","line");
setLikesDislikes(postJSON[it].postid,it,index);
            var aButtonComment=document.createElement("a");
            aButtonComment.setAttribute("href", "post_page.php?post="+postJSON[it].postid);
            var buttonComment = document.createElement("button");
            buttonComment.setAttribute("class","btn btn-default button-comment");
            buttonComment.setAttribute("type","button");
            buttonComment.innerHTML="See comments";
            aButtonComment.appendChild(buttonComment);
            
        //adding all that back to our row
         rowDetails.appendChild(divMedia);
        // rowDetails.appendChild(aPostName);
        // rowDetails.appendChild(pPostPlace);
        // rowDetails.appendChild(pPostTimeStamp);
        rowDetails.appendChild(pPostDescription);
        rowDetails.appendChild(pLine);
        rowDetails.appendChild(buttonLike);
        rowDetails.appendChild(buttonDislike);
        rowDetails.appendChild(aButtonComment);
        rowDetails.appendChild(pLine2);
        //slapping it onto our container
        outerDiv.appendChild(postDiv);
        container.appendChild(outerDiv);
        
    }

}


//WARNING: Every function below is what you should be editing if you wanna play around with some post things

/**
 * @param elem - this is the element itself
 */
function setLikesDislikes(postid,it,index){
    $.post('ajax/db_dealer.php', {type: "get", command: "getLikeUser", postid: postid}, function(data) //we expect data to be: L, D, or N
        {
        var likebtn = '#post-like-btn'+(it+index);
        var unlikebtn = '#post-unlike-btn'+(it+index);
            switch(data)
            {
                case 'N'://Neutral  (+1 for like)                   -> db value is now L
                   $(likebtn).attr("style","background-color:white;");
                    $(unlikebtn).attr("style","background-color:white;");
                break;
                case 'L'://Liked    (-1 for like)                   -> db value is now N
                    $(likebtn).attr("style","background-color:darkgreen;color:white;");
                break;
                case 'D'://Disliked (+1 for like, -1 for dislike)   -> db value is now L
                    $(unlikebtn).attr("style","background-color:red;");
                break;
            }
        }); 
}

function thumbsUp(elem)   //for post @param elem is the button itself
{
    // alert(id.id);
    if(!isGuest)
    {
        
        var postRating = elem.children[0]; //element that contains our like post rating
        var postIndex = postRating.getAttribute("id").substr(10); //id is post-likes which is 10 characters
        var thumbdownelem = document.getElementById('post-dislikes'+postIndex);

        $.post('ajax/db_dealer.php', {type: "get", command: "postOpinion", postid: elem.dataset.postid}, function(data) //we expect data to be: L, D, or N
        {
            // alert(data +" prev opinion");
            switch(data)
            {
                case 'N'://Neutral  (+1 for like)                   -> db value is now L
                    postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                    givePostOpinion(elem.dataset.postid, "L");
                break;
                case 'L'://Liked    (-1 for like)                   -> db value is now N
                    postRating.innerHTML = parseInt(postRating.innerHTML) -1 +" ";
                    givePostOpinion(elem.dataset.postid, "N");
                break;
                case 'D'://Disliked (+1 for like, -1 for dislike)   -> db value is now L
                    postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                    thumbdownelem.innerHTML = parseInt(thumbdownelem.innerHTML) -1 +" ";
                    givePostOpinion(elem.dataset.postid, "L");
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
        var postIndex = postRating.getAttribute("id").substr(13); //id is post-dislikes which is 13 characters
        var thumbupelem = document.getElementById('post-likes'+postIndex);
        

        $.post('ajax/db_dealer.php', {type:"get", command:"postOpinion", postid: elem.dataset.postid}, function(data) //we expect data to be: L, D, or N
        {
            switch(data)
            {
                case 'N'://Neutral  (+1 for dislike)                -> db value is now D
                    postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                    givePostOpinion(elem.dataset.postid, "D");
                break;
                case 'L'://Liked    (+1 for dislike, -1 for like)   -> db value is now D
                    postRating.innerHTML = parseInt(postRating.innerHTML) +1 +" ";
                    thumbupelem.innerHTML = parseInt(thumbupelem.innerHTML) -1 +" ";
                    givePostOpinion(elem.dataset.postid, "D");
                break;
                case 'D'://Disliked (-1 for dislike)                -> db value is now N
                    postRating.innerHTML = parseInt(postRating.innerHTML) -1 +" ";
                    givePostOpinion(elem.dataset.postid, "N");
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

function thumbsUpComment(elem)
{
    if(!isGuest)
    {
        var commentRating = elem.children[0]; //index 0 because the first child of this element contains our commentid  
        var commentIndex = elem.getAttribute("id").substr(16); //id is comment-like-btn which is 16 characters
        var thumbdownelem = document.getElementById('comment-dislike-btn'+commentIndex);
        //first we check what status the user has with the comment
        /*
        <input type="text" id="foo" data-something="something" value="bar">
        and the javascript.

        var el = document.getElementById("foo"); 

        console.log(el.value) // bar
        console.log(el.getAttribute("id")) // foo
        console.log(el.dataset.something) //something
        */ 
        $.post('ajax/db_dealer.php', {type:"get", command:"commentOpinion", commentid: commentRating.dataset.commentid}, function(data) //we expect data to be: L, D, or N
        {
            // alert(data +" prev opinion");
            switch(data)
            {
                case 'N'://Neutral  (+1 for like)                   -> db value is now L
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) +1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "L");
                break;
                case 'L'://Liked    (-1 for like)                -> db value is now N
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) -1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "N");
                break;
                case 'D'://Disliked (+1 for like, -1 for dislike)   -> db value is now L
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) +1 +" ";
                    thumbdownelem.children[0].innerHTML = parseInt(thumbdownelem.children[0].innerHTML) -1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "L");
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
function thumbsDownComment(elem)
{
    if(!isGuest)
    {
        var commentRating = elem.children[0];
        var commentIndex = elem.getAttribute("id").substr(19); //id is comment-dislike-btn which is 19 characters
        var thumbupelem = document.getElementById('comment-like-btn'+commentIndex);
        // alert("hey " +commentIndex);
        // alert(document.getElementById('comment-dislike-btn'+commentIndex).children[0].innerHTML +" complexshiz");

        $.post('ajax/db_dealer.php', {type:"get", command:"commentOpinion", commentid: commentRating.dataset.commentid}, function(data) //we expect data to be: L, D, or N
        {
            // alert(data +" prev opinion");
            switch(data)
            {
                case 'N'://Neutral  (+1 for dislike)                -> db value is now D
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) +1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "D");
                break;
                case 'L'://Liked    (+1 for dislike, -1 for like)   -> db value is now D
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) +1 +" ";
                    thumbupelem.children[0].innerHTML = parseInt(thumbupelem.children[0].innerHTML) -1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "D");
                break;
                case 'D'://Disliked (-1 for dislike)                -> db value is now N
                    commentRating.innerHTML = parseInt(commentRating.innerHTML) -1 +" ";
                    giveCommentOpinion(commentRating.dataset.commentid, "N");
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
function giveCommentOpinion(commentid, opinion)
{
    $.post('ajax/db_dealer.php', {type: "set", command: "commentOpinion", commentid: commentid, opinion: opinion});
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

function setChildren() //unused method.
{
    var liCar0 = document.createElement("li");
                liCar0.setAttribute("data-target","#post-carousel"+it+index);
                liCar0.setAttribute("data-slide-to","0");
                liCar0.setAttribute("class","active");
                var liCar1 = document.createElement("li");
                liCar1.setAttribute("data-target","#post-carousel"+it+index);
                liCar1.setAttribute("data-slide-to","1");
                var liCar2 = document.createElement("li");
                liCar2.setAttribute("data-target","#post-carousel"+it+index);
                liCar2.setAttribute("data-slide-to","2");
                //adding them to parent
                olCarousel.appendChild(liCar0);
                olCarousel.appendChild(liCar1);
                olCarousel.appendChild(liCar2);

                //divCarouselInner
            var divCarouselInner = document.createElement("div");
            divCarouselInner.setAttribute("class","carousel-inner");
                /*divCarouselInner-children*/
                //divItemActive
                var divItemActive = document.createElement("div");
                divItemActive.setAttribute("class","item active");
                    /*divItemActive-children*/
                    var img0 = document.createElement("img");
                    img0.setAttribute("src","images/postimages/1img1.png");
                    img0.setAttribute("alt","Los Angeles");
                    divItemActive.appendChild(img0);
                //divItem1
                var divItem1 = document.createElement("div");
                divItem1.setAttribute("class","item");
                    /*divItem1-children*/
                    var img1 = document.createElement("img");
                    img1.setAttribute("src","images/postimages/1img2.png");
                    img1.setAttribute("alt","Chicago");
                    divItem1.appendChild(img1);
                //divItem2
                var divItem2 = document.createElement("div");
                divItem2.setAttribute("class","item");
                    /*divItem2-children*/
                    var img2 = document.createElement("img");
                    img2.setAttribute("src","images/postimages/1img3.png");
                    img2.setAttribute("alt","New York");
                    divItem2.appendChild(img2);
                divCarouselInner.appendChild(divItemActive);
                divCarouselInner.appendChild(divItem1);
                divCarouselInner.appendChild(divItem2);



}