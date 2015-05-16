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

//function that is going to connect to instagram.
function connectToInstagram($url){
    $ch = curl_init();

    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 2,

        ));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;

}
//function to get userID cause username doesnt allow us to get pictures.
function getUserID($userName) {
    $url = 'https://api.instagram.com/v1/users/search?q='.$userName.'&client_id='.clientID;
    $instagramInfo = connectToInstagram($url);
    $results = json_decode($instagramInfo, true);

    return $results['data'][0]['id'];
}
// function to print out images onto screen
function printImages($userID){
    $url = 'https://api.instagram.com/v1/users/'.$userID. '/media/recent?client_id='.clientID.'&count=5';
    $instagramInfo = connectToInstagram($url);
    $results = json_decode($instagramInfo, true);
    // parse through the info one by one
    foreach ($results['data'] as $items) {
        $image_url = $items['images']['low_resolution']['url']; //going to go through all of my results and give myself back the URL of those pictures because we want to save it to the PHP server.
        echo '<img src=" '.$image_url.'"/><br/>';
        savePictures($image_url);
    }
}
// function to save image to server
function savePictures($image_url) {
    echo $image_url .'<br>';
    $filename = basename($image_url); // the filename is what were storing, basename is the PHP built in method that we are using to store $image_url
    echo $filename . '<br>';

    $destination = ImageDirectory . $filename;
    file_put_contents($destination, file_get_contents($image_url)); // goes and grabs imagefile and stores it in our server
}


if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $url = 'https://api.instagram.com/oauth/access_token';
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

$result = curl_exec($curl);
curl_close($curl);

//echo $result; to test whether $result was coming back as an array which it is
$results = json_decode($result, true);

$userName = $results['user']['username'];

$userID = getUserID($userName);

printImages($userID);
}
else { 
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
       <!-- Creating a login for people and give approval four our web app to access their Instagram account
			After getting approval we are now going to have the information so that we can play with it.
        -->
       <a href="https://api.instagram.com/oauth/authorize/?client_id=<?php echo clientID; ?>&redirect_uri=<?php echo redirectURI?>&response_type=code">Login</a>
        <script src="js/main.js"></script>
    </body>
</html>
<?php 
}
?>

<!-- CLIENT INFO
CLIENT ID	28a677810dee4544a961906ef66d04f4
CLIENT SECRET	9a7d8d0c9bc54030a4e8295f3b27a08d
WEBSITE URL	http://localhost8888/appacademyapi/index.php
REDIRECT URI	http://localhost8888/appacademyapi/index.php -->