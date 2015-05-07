<?php
//Configuration for our PHP Server
set_time_limit(0);
ini_set('default_socket_timeout', 300);
session_start();

//make constants using define.
define('client_id', '28a677810dee4544a961906ef66d04f4');
define('client_secret', '9a7d8d0c9bc54030a4e8295f3b27a08d');
define('redirectURI', 'http://localhost8888/appacademyapi/index.php');
define('ImageDirectory', 'pics/');

?>


<!-- CLIENT INFO
CLIENT ID	28a677810dee4544a961906ef66d04f4
CLIENT SECRET	9a7d8d0c9bc54030a4e8295f3b27a08d
WEBSITE URL	http://localhost8888/appacademyapi/index.php
REDIRECT URI	http://localhost8888/appacademyapi/index.php -->