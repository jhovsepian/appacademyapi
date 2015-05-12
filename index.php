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

if (isset($GET['code'])) {
    $code = ($GET['code']);
    $url = 'https://api.instagram.com/oauth_token';
    $access_token_settings = array('client_id' => clientID, 
                                   'client_secret' => clientSecret,
                                   'grant_type' => 'authorization_code',
                                   'redirect_uri' => redirectURI,
                                   'code' => $code
                                    );
    //cURL is what we use in PHP, its a library calls to other API's.
    $curl = curl_init($url); // setting a cURL session and we put in $url because thats where we are getting the data from.
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $access_token_settings); // setting the POSTFIELDS to the array setup that we created.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // setting it equal to 1 because we are getting strings back.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// but in live work-production we want to set this to true.
}
$result = curl_exec($curl);
curl_close();
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