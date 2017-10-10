// var commsec = document.getElementById("comments_sec");
function spawn()
{
var a = document.createElement("a");//Author of comment
// a.setAttribute("id", comments[0].author); // unintended code, but a good observation on external ID definition
a.setAttribute("href", "#");

var author = document.createElement("b");
author.setAttribute("id", "authorDefault");
a.appendChild(author);

var a2 = document.createElement("text"); //Likes static text
a2.setAttribute("id","commentDefault");

var a3 = document.createElement("text"); //actual likes value
a3.innerHTML = "Likes: ";

var a4 = document.createElement("b"); //actual likes value
a4.innerHTML = 0 +" ";
a4.setAttribute("id","likesDefault");

var a5 = document.createElement("text"); //dislikes
a5.innerHTML = "Dislikes: ";

var a6 = document.createElement("b"); //actual dislike value
a6.innerHTML = 0 +" ";
a6.setAttribute("id","dislikesDefault");


//adding to comments section
commsec.appendChild(a);
commsec.appendChild(document.createElement("br"));
commsec.appendChild(a2);
commsec.appendChild(document.createElement("br"));
commsec.appendChild(a3);
commsec.appendChild(a4);
commsec.appendChild(a5);
commsec.appendChild(a6);
commsec.appendChild(document.createElement("br"));
commsec.appendChild(document.createElement("br"));

}