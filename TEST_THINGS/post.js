class Post
{
    constructor(postid, auth, place, isMedia, desc, likes, dislikes, favnum, timestamp) //just realized there's no overloading in javascript
    {
        this._postid = postid;
        this._author = auth;
        this._place = place;
        this._isMedia = isMedia;
        this._description = desc;
        this._likes = likes;
        this._dislikes = dislikes;
        this._favnum = favnum;
        this._timestamp = timestamp;
    };

    func(gooc)
    {   
        return this.author +this.description +this.postid +gooc;
    }
    spawnPost(doc, div) //this is just for tests
    {
        var x = doc.createElement("b");
        x.innerHTML = this._author;
        var y = doc.createElement("b");
        y.innerHTML = this._description;
        div.appendChild(x);
        div.appendChild(doc.createElement("br"));
        div.appendChild(y);
        doc.body.appendChild(div);
    }
    

    /*  this.postid = postid;
        this.author = auth;
        this.place = place;
        this.isMedia = isMedia;
        this.description = desc;
        this.likes = likes;
        this.dislikes = dislikes;
        this.favnum = favnum;
        this.timestamp = timestamp;
    */
}