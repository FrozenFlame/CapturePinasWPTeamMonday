<!--* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
*       Created by Denzel
*       21-SEP-17
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * -->

<html>
<head>
<title>Content Deployment Test</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src = "../js/jquery-3.2.1.js"></script>

<!-- SCRIPTS -->
<script>

        
        var content = new Array(4); // where we storin our goods
        var ez = "chill";
        /*window.onload = function()
        {
            if (window.jQuery)
            {
                alert('jQuery is loaded');
            }
            else
            {
                alert('jQuery is not loaded');
            }
        
        }*/
         var pos = 0;
        $(document).ready(function()
        {
            $("button").click(function()
            {
                $.get("content.txt", function(data, status)
                {
                    $("#content"+pos++).html(data);
                }); 
            });
        });

        /*
            $.post("getinfo.php", {postid: "cor r", index: i}, function(data)
            {
                var tryx = data;
                document.getElementById('content'+i).innerHTML = tryx;
            });
        */
        
        //document.write(ez);
           
        //document.getElementById('content1').innerHTML = ;
        
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

    <div id="gitgud"></div>
    
</body>

</html>
