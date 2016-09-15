<!DOCTYPE html>
<html>
<head>
    <title>leaderboard</title>
    <script>
    var x = 1;
       
            if(x==1){
                document.getElementById("sknop").click();    
                x=3;
            }
            

        
    </script>
</head>
<body>

</body>
</html>
<?php

/*
 * Khan Academy API sample PHP client.
 *
 * See the README for instructions, and the comments below for the details on
 * the individual steps.
 */

include_once 'oauth-php/library/OAuthStore.php';
include_once 'oauth-php/library/OAuthRequester.php';
include_once  'config.php';

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

} elseif (!empty($_GET['logged_in'])) {
    /*
     * Main logged-in page. Display a form for typing in a query, and execute a
     * query and display its results if one was specified.
     */
    $defaultQuery = !empty($_GET['query']);
    if (!$defaultQuery) {
        $defaultQuery = '/api/v1/user/students';
    }
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
