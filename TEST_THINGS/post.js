class post
{
  
    constructor(postid, auth, place, isMedia, desc, likes, dislikes, favnum, timestamp) //just realized there's no overloading in javascript
    {
        this.postid = postid;
        this.author = auth;
        this.place = place;
        this.isMedia = isMedia;
        this.description = desc;
        this.likes = likes;
        this.dislikes = dislikes;
        this.favnum = favnum;
        this.timestamp = timestamp;
        // this

        // this.method1 = function func(gooc)
        // {
        //     return auth +desc +postnum +gooc;
        // };
    };

    func(gooc)
    {
        return this.author +this.description +this.postid +gooc;
    }

    spawnPost(doc, div)
    {
        var x = doc.createElement("b");
        x.innerHTML = this.author;
        
        var y = doc.createElement("b");
        y.innerHTML = this.description;

        div.appendChild(x);
        div.appendChild(doc.createElement("br"));
        div.appendChild(y);
       /* doc.body.appendChild(x);
        doc.body.appendChild(doc.createElement("br"));
        doc.body.appendChild(y);
*/
        // div.createElement();
        doc.body.appendChild(div);
    }
   
}
/*
constructor(author, description)
{
    this._author = author;
    this._descrition = description;
}

function getAuthor()
{
    return _author;
}*/

/*

constructor(author, description, postIndex)
{
    this._author = author;
    this._description = description;
    this._postIndex = postIndex;
}

// function getAuthor()
// {
    
// }
function toElement(divElement)
{
    var auth = document.createElement("b");
    auth.innerHTML = _author;
    var desc = document.createElement("a");
    desc.innerHTML = _description;
    
    divElement.appendChild(auth);
    divElement.appendChild(desc);
}

function getAuthor()
{
    return _author;
}*/

// function exampleClass()
// {
//     this.property1 = 5;
//     this.property2 = "World";
//     this.method1 = function method1 (arg1)
//     {
//         return arg1 +" " +property2;
//     }
// }

