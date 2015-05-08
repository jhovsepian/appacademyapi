<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//make constants using define.
define('clientID', '28a677810dee4544a961906ef66d04f4');
define('clientSecret', '9a7d8d0c9bc54030a4e8295f3b27a08d');
define('redirectURI', 'http://localhost/appacademyapi/index.php');
define('ImageDirectory', 'pics/');

?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
       <!-- Creating a login for people and give approval four our web app to access their Instagram account
			After getting approval we are now going to have the information so that we can play with it.
        -->
       <a href="https:api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI?>&response_type=code">LOGIN</a>
        <script src="js/main.js"></script>
    </body>
</html>


<!-- CLIENT INFO
CLIENT ID	28a677810dee4544a961906ef66d04f4
CLIENT SECRET	9a7d8d0c9bc54030a4e8295f3b27a08d
WEBSITE URL	http://localhost8888/appacademyapi/index.php
REDIRECT URI	http://localhost8888/appacademyapi/index.php -->