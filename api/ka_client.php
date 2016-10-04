<!DOCTYPE html>
<html>
<head>
    <title>leaderboard</title>
    <script>
    //    document.getElementById("sknop").click();\

    var time = 1000 * 60 * 60 * 24; // 24 hours
	setTimeout(function(){
		location.reload();
   	},time);

    </script>
</head>
<body>

</body>
</html>
<?php
session_start();
include_once 'oauth-php/library/OAuthStore.php';
include_once 'oauth-php/library/OAuthRequester.php';
include_once 'config.php';
include_once 'db.php';
include_once '../app/classes/leaderboard.class.php';

/*
 * Khan Academy API sample PHP client.
 *
 * See the README for instructions, and the comments below for the details on
 * the individual steps.
 */

/*
var_dump($_SESSION["oauth_5xLdMmpejfNeYvbw"]);

setcookie("consumer_key", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["consumer_key"],time() + 9999999999999999);
setcookie("consumer_secret", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["consumer_secret"],time() + 9999999999999999);
setcookie("server_uri", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["server_uri"],time() + 9999999999999999);
setcookie("request_token_uri", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["request_token_uri"],time() + 9999999999999999);
setcookie("access_token_uri", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["access_token_uri"],time() + 9999999999999999);
setcookie("token_type", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["token_type"],time() + 9999999999999999);
setcookie("token", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["token"],time() + 9999999999999999);
setcookie("token_secret", $_SESSION["oauth_5xLdMmpejfNeYvbw"]["token_secret"],time() + 9999999999999999);

var_dump($_COOKIE);
$_SESSION["oauth_5xLdMmpejfNeYvbw"] = $_COOKIE;
*/

if(Leaderboard::getSession() != "")
{
    //$_SESSION = unserialize("a%3A1%3A%7Bs%3A22%3A%22oauth_5xLdMmpejfNeYvbw%22%3Ba%3A10%3A%7Bs%3A12%3A%22consumer_key%22%3Bs%3A16%3A%225xLdMmpejfNeYvbw%22%3Bs%3A15%3A%22consumer_secret%22%3Bs%3A16%3A%22r5czsqpG5cUsXW9K%22%3Bs%3A17%3A%22signature_methods%22%3Ba%3A1%3A%7Bi%3A0%3Bs%3A9%3A%22HMAC-SHA1%22%3B%7Ds%3A10%3A%22server_uri%22%3Bs%3A27%3A%22https%3A%2F%2Fwww.khanacademy.org%22%3Bs%3A17%3A%22request_token_uri%22%3Bs%3A50%3A%22https%3A%2F%2Fwww.khanacademy.org%2Fapi%2Fauth%2Frequest_token%22%3Bs%3A13%3A%22authorize_uri%22%3Bs%3A46%3A%22https%3A%2F%2Fwww.khanacademy.org%2Fapi%2Fauth%2Fauthorize%22%3Bs%3A16%3A%22access_token_uri%22%3Bs%3A49%3A%22https%3A%2F%2Fwww.khanacademy.org%2Fapi%2Fauth%2Faccess_token%22%3Bs%3A10%3A%22token_type%22%3Bs%3A6%3A%22access%22%3Bs%3A5%3A%22token%22%3Bs%3A17%3A%22t6747367726252032%22%3Bs%3A12%3A%22token_secret%22%3Bs%3A16%3A%22pYpMtmGFyEBw4WGU%22%3B%7D%7D");
    //$_SESSION = unserialize($_COOKIE["Session_cookie"]);
    //setcookie("Session_cookie", serialize($_SESSION), time()+360000000);
    //$session_json = json_encode($_COOKIE["Session_cookie"]);
    
    //var_dump($session_json);
    //var_dump($_COOKIE["Session_cookie"]);
    var_dump(Leaderboard::getSession());
    if (Leaderboard::getSession() == "") {
        $session_json =  $_COOKIE["Session_cookie"];
        Leaderboard::setSession($session_json);
        $_SESSION = unserialize(Leaderboard::getSession());
        //var_dump(Leaderboard::getSession());

    }else
    {
        $_SESSION = unserialize(Leaderboard::getSession());
        //$_SESSION = unserialize(Leaderboard::getSession());
        //var_dump($_SESSION);
    }
    

  
    //$_SESSION = unserialize(json_decode($session_json));
}
//var_dump($_SESSION);

//var_dump($_COOKIE["Session_cookie"]);
//echo $_COOKIE["Session_cookie"];
//echo "<br/>";
//echo strlen($_COOKIE["Session_cookie"]);
//var_dump(unserialize($_COOKIE["Session_cookie"]));

$baseUrl = 'https://www.khanacademy.org';
$requestTokenUrl = $baseUrl.'/api/auth/request_token';
$accessTokenUrl = $baseUrl.'/api/auth/access_token';

$options = array(
    'consumer_key' => $consumerKey,
    'consumer_secret' => $consumerSecret,
    'server_uri' => $baseUrl,
    'signature_methods' => array('HMAC-SHA1'),
    'request_token_uri' => $requestTokenUrl,
    'authorize_uri' => $baseUrl.'/api/auth/authorize',
    'access_token_uri' => $accessTokenUrl,
);

$store = OAuthStore::instance('Session', $options);

if (!empty($_GET['login'])) {
    /*
     * Initial login handler (accessed by specifying login=1). Unlike most OAuth
     * APIs, the KA API skips the "authorize" step, and instead guides the user
     * through the login process directly from /api/auth/request_token . That
     * endpoint redirects to a login page, which redirects back to a
     * loginCallback of our choosing. Since this is a different flow from what
     * the OAuth library expects, we need to have oauth-php sign the request
     * without submitting it (since it's expecting to directly get a token
     * back), then redirect the user to the resulting URL.
     */
    $requestTokenParams = array('oauth_callback' => $loginCallback);
    $userId = 0;
    $server = $store->getServer($consumerKey, $userId);

    $request = new OAuthRequester($requestTokenUrl, 'GET', $requestTokenParams);
    $request->sign($userId, $server, '', 'requestToken');
    $queryParams = $request->getQueryString(false);
    header('Location: '.$requestTokenUrl.'?'.$queryParams);

} elseif (!empty($_GET['oauth_token'])) {
    /*
     * Login callback. After the user logs in, they are redirected back to this
     * page with the oauth_token field specified. We then can use that token (as
     * well as some other request params) to get an access token to use
     *
     * Once the access token is obtained, we immediately redirect to the main
     * logged-in page to allow the user to make requests.
     */
    $oauthToken = $_GET['oauth_token'];
    $oauthTokenSecret = $_GET['oauth_token_secret'];
    
    $store->addServerToken($consumerKey, 'request', $oauthToken, $oauthTokenSecret, 0);

    $accessTokenParams = array(
        'oauth_verifier' => $_GET['oauth_verifier'],
        'oauth_callback' => $loginCallback);
    
    OAuthRequester::requestAccessToken($consumerKey, $oauthToken, 0, 'POST', $accessTokenParams);
    header('Location: ka_client.php?logged_in=1');

} elseif (!empty($_GET['logged_in']) || Leaderboard::getSession() != "" ) {
    /*
     * Main logged-in page. Display a form for typing in a query, and execute a
     * query and display its results if one was specified.
     */
    //setcookie("Session_cookie", serialize($_SESSION), time()+360000000);
    $defaultQuery = !empty($_GET['query']);
     if ($defaultQuery == 1)
    {
        $defaultQuery = "";
    }
    if (!$defaultQuery) {
        $defaultQuery = '/api/v1/user/students';
    }
        $request = new OAuthRequester($baseUrl.$defaultQuery, 'GET');
        $result = $request->doRequest(0);
        //echo 'Response: <br><code>'. var_dump(json_decode($result['body'])).'</code>';
        $resultObject = json_decode($result['body']);
        //var_dump($resultObject);

        $students = leaderboard::getStudentsAlltime($resultObject);
        Leaderboard::insertStudents($students);

        //students all time
            $students = [];
        //    echo "<h1>Alle studenten</h1>";
            foreach ($resultObject as $student) {
                //echo "<h3>{$student->student_summary->username}</h3>";

    //            echo "<h4>Behaalde badges</h4>";

  //              var_dump($student->badge_counts);

                $badgeCount = 0;
                for ($i=0; $i <=5 ; $i++) { 
                    $badgeCount += $student->badge_counts->$i;
                }
/*
                echo "Badge count:";
                var_dump($badgeCount);
*/
                $students[$student->student_summary->nickname] = $badgeCount;
                //$students[$student->student_summary->username] = $student->student_summary->nickname;
            }
            arsort($students);
            //var_dump($students);

            
            //Students by class
            $studentsByClass = [];

            $file = fopen("../app/klassen.csv","r");
            $classes = Leaderboard::sortByClass($file);
            var_dump($classes);
            foreach ($classes as $class => $studentMails) {
                var_dump($class);
                foreach ($studentMails as $studentMail) {
                    var_dump($studentMail);
                    foreach ($resultObject as $student) {
                        if ($student->student_summary->email == $studentMail) {
                            $badgeCount = 0;
                            for ($i=0; $i <=5 ; $i++) { 
                                $badgeCount += $student->badge_counts->$i;
                            }
                            //add to array
                            var_dump($student->student_summary);
                            $studentsByClass[$class][$student->student_summary->nickname] = $badgeCount;
                        }
                    }
                }
            }
            var_dump($studentsByClass);

            /*
            foreach ($resultObject as $student) {
                var_dump($student->student_summary->email);
            }*/
?>
    Make a GET request:
    <form>
        <input type="hidden" name="logged_in" value=1>
        <input type="text" name="query" value="<?php echo $defaultQuery; ?>" size=40><br>
        <input type="submit" id= "sknop" value="Submit">
    </form>
<?php

    if (!empty($_GET['query'])) {
        $request = new OAuthRequester($baseUrl.$_GET['query'], 'GET');
        $result = $request->doRequest(0);
        //echo 'Response: <br><code>'. var_dump(json_decode($result['body'])).'</code>';
        $resultObject = json_decode($result['body']);
        var_dump($resultObject);
    }
} else {
    /*
     * Default handler: show a button that redirects to the login handler.
     */
?>

    <form>
        <input type="hidden" name="login" value=1>
        <button type=submit>Log in...</button>
    </form>
<?php
}
