// Team Monday

/***********************************************************************
 *  Post design by       : Jarvis 
 *  Conversion to DOM by : Denzel
 *  13-OCT-17
 ***********************************************************************/

/**
 * @param {element} container - This is the html element you wish to insert the content into.
 * @param {string} json - The data you wish to insert must be in a JSON STRING format.
 * @param {int} index - The index for the unique id acquisition.
 */
function createPostLite(container, json, index)
{
    // setting of JSON content will be synced
        var postJSON;
        postJSON = JSON.parse(json);
    
    //basically, every item here needs to have some kind of naming convention attached to them + the uniqueID
    // might need some algorithm in separate functions for this, for variable length things like images uploaded
    //OKAY, while working it stumbled in my mind that maybe we don't needto give a unique ID to EVERYTHING after all
    for(var it = 0; it < postJSON.length; it++) 
    {
        var outerDiv = document.createElement("div"); // main container of an individual post_lite
        outerDiv.setAttribute("class", "class=\"col-sm-offset-2 col-offset-xs-0 col-sm-8 col-xs-12 post-container\"");

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
        var pTitle = document.createElement("p");
        pTitle.setAttribute("id", "post-title-p");
        var bTitle = document.createElement("b");
        bTitle.setAttribute("id", "post-title");
        pTitle.appendChild(bTitle);
        rowTitle.appendChild(pTitle);

        //rowCarousel
        var divCarousel = document.createElement("div");
        divCarousel.setAttribute("id","post-carousel");
        divCarousel.setAttribute("class","carousel slide");
        divCarousel.setAttribute("data-ride", "carousel");
        /*rowCarousel-children*/
            //olCarousel
            var olCarousel = document.createElement("ol");//THIS WILL NEED AN ALGORITHM FOR VARYING PICTURE AMOUNTS 
            olCarousel.setAttribute("class","carousel-indicators");
                /*olCarousel-children*/
                //THIS IS WHERE YOU NEED TO ITERATE
                //for now we shall be using the temporary stock pictures
                var liCar0 = document.createElement("li");
                liCar0.setAttribute("data-target","#post-carousel");
                liCar0.setAttribute("data-slide-to","0");
                liCar0.setAttribute("class","active");
                var liCar1 = document.createElement("li");
                liCar1.setAttribute("data-target","#post-carousel");
                liCar1.setAttribute("data-slide-to","1");
                var liCar2 = document.createElement("li");
                liCar2.setAttribute("data-target","#post-carousel");
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
                    img0.setAttribute("src","images/4.jpg");
                    img0.setAttribute("alt","Los Angeles");
                    divItemActive.appendChild(img0);
                //divItem1
                var divItem1 = document.createElement("div");
                divItem1.setAttribute("class","item");
                    /*divItem1-children*/
                    var img1 = document.createElement("img");
                    img1.setAttribute("src","images/2.jpg");
                    img1.setAttribute("alt","Chicago");
                    divItem1.appendChild(img1);
                //divItem2
                var divItem2 = document.createElement("div");
                    /*divItem2-children*/
                    var img2 = document.createElement("img");
                    img2.setAttribute("src","images/3.jpg");
                    img2.setAttribute("alt","New York");
                    divItem2.appendChild(img2);
                divCarouselInner.appendChild(divItemActive);
                divCarouselInner.appendChild(divItem1);
                divCarouselInner.appendChild(divItem2);
            //aLeftControl
            var aLeftControl = document.createElement("a");
            aLeftControl.setAttribute("class","left carousel-control");
            aLeftControl.setAttribute("href","#post-carousel");
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
            aRightControl.setAttribute("href","#post-carousel");
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
        
        //rowDetails
        var divDetails = document.createElement("div");
        divDetails.setAttribute("class","row");
            /*divDetails-children*/
            //aPostName
            var aPostName = document.createElement("a");
            aPostName.setAttribute("href", "#"); //painful... this needs yet another algorithm
            aPostName.setAttribute("id","post-href");
                /*aPostName-children*/
                var pPostName = document.createElement("p");
                var bPostName = document.createElement("b");
                bPostName.setAttribute("id", "post-name");
                pPostName.appendChild(bPostName);
                aPostName.appendChild(pPostName);
            //pPostPlace
            var pPostPlace = document.createElement("p");
                /*pPostPlace-children*/
                var text = document.createElement("text");
                text.innerHTML = "in ";
                var bPostPlace = document.createElement("b");
                bPostPlace.setAttribute("id", "post-place");
                pPostPlace.appendChild(text);
                pPostPlace.appendChild(bPostPlace);
            //pPostTimeStamp
            var pPostTimeStamp = document.createElement("p");
            pPostTimeStamp.setAttribute("id","post-timestamp");
            //pPostDescription
            var pPostDescription = document.createElement("p");
            pPostDescription.setAttribute("id","post-timestamp");
            //line
            var pLine = document.createElement("p");
            pLine.setAttribute("id","line");
            /*like dislike buttons*/
            //like
            var buttonLike = document.createElement("button");
            buttonLike.setAttribute("class","btn btn-default");
            buttonLike.setAttribute("type","button");
            buttonLike.setAttribute("id","post-like-btn");
                /*buttonLike-children*/
                var buttonTextLike = document.createElement("button");
                buttonTextLike.setAttribute("id","post-likes");
                buttonTextLike.innerHTML = 0;
                var spanLike = document.createElement("span");
                spanLike.setAttribute("class","glyphicon glyphicon-thumbs-up");
                spanLike.setAttribute("aria-hidden","true");
            buttonLike.appendChild(buttonTextLike);
            buttonLike.appendChild(spanLike);
            //dislike
            var buttonDislike = document.createElement("button");
            buttonDislike.setAttribute("class","btn btn-default");
            buttonDislike.setAttribute("type","button");
            buttonDislike.setAttribute("id","post-unlike-btn");
                /*buttonLike-children*/
                var buttonTextDislike = document.createElement("button");
                buttonTextDislike.setAttribute("id","post-dislikes");
                buttonTextDislike.innerHTML = 0;
                var spanDislike = document.createElement("span");
                spanDislike.setAttribute("class","glyphicon glyphicon-thumbs-down");
                spanDislike.setAttribute("aria-hidden","true");
            buttonDislike.appendChild(buttonTextDislike);
            buttonDislike.appendChild(spanDislike);
            var pLine2 = document.createElement("p");
            pLine2.setAttribute("id","line");
        //adding all that back to our row
        divDetails.appendChild(pPostName);
        divDetails.appendChild(pPostPlace);
        divDetails.appendChild(pPostTimeStamp);
        divDetails.appendChild(pPostDescription);
        divDetails.appendChild(pLine);
        divDetails.appendChild(buttonLike);
        divDetails.appendChild(buttonDislike);
        divDetails.appendChild(pLine2);

        //slapping it onto our container
        outerDiv.appendChild(postDiv);
        container.appendChild(outerDiv);
        
        
        
        
    }
}
