<!DOCTYPE html>
<?php
    session_start();
    include("usefulfunctions.php");

    //check to see if user is logged in
    //loginCheck();

?>
<html>
<meta charset = "UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<style>

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}

h1 {
	color: green;
	text-align:center;
	text-decoration: underline;
}


h2{
	color: black;
	text-align:center;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #FF0000;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle;}



</style>
</head>

<body>
<ul>
 <li><a href="index.html">Home</a></li>
	  <li><a href="dashboard.php">Dashboard</a></li> 
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>
<div style="width:100%;">
<div style="float:left; width:50%;">
<h1><b>Welcome back!</b></h1>

<img src="popcorn.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h2>Here are your latest movie preferences!</h2>

</div>

<div style= "float:right; width:50%">
 <h1>  Movie Information:</h1>
  <input id = 'movieTitle' name = 'movieTitle' placeholder='Enter Movie name' autocomplete='off' min='0' required>
  <button id = 'btn' type = 'BUTTON'><b><font color= ' #008000'>Search Movie</font></b></button>
  
   <br>

<div id= "B"></div>
</div>
</div>
</script>
    <div class= "split right">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        
        <script type = "text/javascript"> 
         $(document).ready( function(){

           $("button").click(function(){ 

             var movieTitle = $("#movieTitle").val();

             if(movieTitle != ''){

                 $.ajax({
                     type:         "GET",
                     url:         "API.php",
                     data:         "movieTitle="+movieTitle,

                     beforeSend: function(){         
                        $("#B").html("Grabbing Movie Data....");
                     },

                     error: function(xhr, status, error) {  
                        alert( "Error Mesaage:  \r\nNumeric code is: "  + xhr.status + " \r\nError is " + error);   
                     },

                     success: function(result){
                        r = JSON.parse(result);
                        res = "<br> Movie Name: "+r.Title+"<br><br> Year: "+r.Year+"<br> <br> Rated: "+r.Rated+"<br><br> Genre: "+r.Genre+"<br>";
                         
                        //get imdbID to store in like/dislike database
                        var imdbID = r.IMDBID;
                        document.cookie = imdbID;

                        poster = "<img src='"+r.Poster+"'>"
                        $("#B").html(res + poster);
                    }
                });
             };    
          });   
        });                

        </script>

    </div>
</body>

</html>
