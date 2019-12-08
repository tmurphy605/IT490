<?php
    session_start();
    include("usefulfunctions.php");
    require_once('../be/path.inc');
    require_once('../be/get_host_info.inc');
    require_once('../be/rabbitMQLib.inc');

    //check to see if user is logged in
    loginCheck();

?>
<!DOCTYPE html>
<html>
<head>
<style>

table, th, td {
	
	border: 1px solid black;
}



.center {
          display: block;
          margin-left: auto;
          margin-right: auto;
          width: 50%;
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
		

</style>
</head>
<body>

<ul>
 <li><a href="index.html">Home</a></li>
	  <li><a href="dashboard.php">Dashboard</a></li> 
	  	  <li><a href="preferences.php">My List</a></li> 
	  	  <li><a href="preferences.php">My Friends</a></li> 
  <li><a href="changepassword.php">Change Password</a></li>
 
 <li><a href="handler_logout.php">Logout</a></li>


</ul>

<img src="Dino2.jpg" style="width:300px; height:300px;" class = "center" align ="auto">

<h1>Here are your friends!</h1>
    <div>
        <h2>Search a friend!</h2>
        <form action="profile.php" method="post">
            <input type="text" name="friendCode">
            <input type="submit" value="Search Friend">
        </form>
    </div>

    <div>
        <?php

            $client = new rabbitMQClient("testRabbitMQ.ini","testServer");

            $request = array();
            $request['type'] = "getFriends";
            $request['email'] = $_SESSION['email'];
            $request['message'] = "getFriends";
            $friends = $client->send_request($request);
            //$likes = $client->publish($request);
            $friendsArray = explode(",", $friends);
        
            $out = "<table><th><td>Likes</td></th>";
            for($x = 0; $x < count($friendsArray); $x++){
                $out .= "<th>" .$friendsArray[$x] ."</td></th>";
            }
            $out .= "<table>";
            echo $out;
        ?>
    </div><br>

</body>
</html>
