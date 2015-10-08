<?php // index.php
require_once 'openid.php';
$openid = new LightOpenID("http://119.18.58.70/~thewebpl/autoSignIn/");

$openid->identity = 'https://www.google.com/accounts/o8/id';
$openid->required = array(
  'namePerson/first',
  'namePerson/last',
  'contact/email',
);
$openid->returnUrl = 'http://119.18.58.70/~thewebpl/autoSignIn/'
?>

<a href="<?php echo $openid->authUrl() ?>">Login with Google</a>