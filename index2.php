<?php
require_once('vendor/autoload.php');

$gclient = new Google_Client();
$gclient->setAuthConfig('credentials_google_oauth.json');
$gclient->setAccessType('offline'); // offline access
$gclient->setIncludeGrantedScopes(true); // incremental auth
$gclient->addScope([Google_Service_Oauth2::USERINFO_EMAIL, Google_Service_Oauth2::USERINFO_PROFILE]);
$gclient->setRedirectUri('https://example.com/'); // 寫憑證設定：「已授權的重新導向 URI 」的網址

 $token = array(
 'access_token' => "放入前端抓到的Token",
 'expires_in' => 3600,
 'scope' => 'https://www.googleapis.com/auth/userinfo.email openid https://www.googleapis.com/auth/userinfo.profile',
 'created' => 1550000000,
);

$gclient->setAccessToken($token); // 設定 Token
$oauth = new Google_Service_Oauth2($gclient);
$profile = $oauth->userinfo->get();
$uid = $profile->id; // Primary key
print_r($profile); // 自行取需要的內容來使用囉~

?>