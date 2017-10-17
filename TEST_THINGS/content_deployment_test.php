<!--* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*       Created by DD_                                                             *
*       21-SEP-17                                                                     *
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->

<html>
<head>
<title>Content Deployment Test</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "../js/jquery-3.2.1.js"></script>
    <script src = "post.js"></script>
<!-- SCRIPTS -->
<script>
        
        var _author;
        var _description;
        var _postIndex;

        // postid, auth, place, isMedia, desc, likes, dislikes, favnum, timestamp
        var ex = new Post(0001, "TheAuthor", "Albay", false, "The description", 2, 30, 1, "13-SomeMonth-99");
        
        var content = new Array(4); // where we storin our goods
        var ez = "chill";
        
        var pos = 0;
        var a = 0;
        var b = 0;
        var c = 0;
        $(document).ready(function() //heavy amounts of playing
        {
            
            $("button#button").click(function()
            {
                $.get("content.txt", function(data, status)
                {
                    $("div#list").append('<b id="post' +a++  +'"> fake</b>');
                });
            });

            $("button#button2").click(function()
            {
                $("b#post"+b++).text('faker');
            });

            // testing array based iteration
            var divz = document.getElementById("content");
            var divs = divz.getElementsByTagName("b");
            for(var i = 0; i < divs.length; i++)
                divs[i].innerHTML = "something new...";
            
            //testing generated content id manipulation
            var x = document.createElement("div");
            var y = document.createElement("b");
            y.innerHTML = "ez dogs";
            y.setAttribute("id", "post1");
            x.appendChild(y);
            
            document.body.appendChild(x);
           
            document.getElementById("post1").innerHTML = "gatcha <br/>";
            
            //adding more content to previous container
            for(var l = 0; l < 5; l++)
            {
                var br = document.createElement("br")
                var item = document.createElement("b");
                item.setAttribute("id", "item"+l);
                x.appendChild(item);
                x.appendChild(br);
            } //NOTE: These elements are empty!

            //testing previous content manipulation
            for(var iteration = 0; iteration < 5; iteration++)
            {
                if(iteration != 2)
                    document.getElementById("item" +iteration).innerHTML = "I am #" +iteration;
                else
                    document.getElementById("item" +iteration).innerHTML = "The third element";
            } // and here the contents have been replaced based on their ids.

            //var gg = new Post("Contraman", "Hey guys this is my post.", 0);
            //gg.toElement(x);

            var divv = document.createElement("div");
            var content = document.createElement("b");
            content.innerHTML = "gitgud";
            divv.appendChild(content);
            divv.appendChild(document.createElement("br"));
            alert(ex.func("goocc"));

            //this one method here is the key
            ex.spawnPost(document, divv);
            //ex has been instantiated above. We have all the power in our hands now boys.

            //stuff below is proof that the logic is usable multiple times:
            divv.appendChild(document.createElement("br"));
            ex.spawnPost(document, divv);
            divv.appendChild(document.createElement("br"));
            ex.spawnPost(document, divv);
            
        });
      
    </script>

</head>

<body>
    <h>Hello world. Content will now appear below: </h>
   
    <div class="container-fluid" id ="list"> 
        <ul id ="table">
        
        <!-- content holder 1 -->
        <li><b id="content0"> </b></li>
        <!-- content holder 2 -->
        <li><b id="content1"> </b></li>
        <!-- content holder 3 -->
        <li><b id="content2"> </b></li>
        <!-- content holder 4 -->
        <li><b id="content3"> </b></li>

        </ul>
    </div>

    <!-- apply content script -->
    <button type="submit" class="btn btn-primary" id="button">Login</button>
    <button type="submit" class="btn btn-primary" id="button2">Login2</button>

    <div id="contentdiv">
        <b>foxtrot</b>
        <?php
            include('template.html'); 
        ?>
    </div>
    
</body>

</html>