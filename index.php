<?php
require_once('vendor/autoload.php');

// https://developers.google.com/identity/protocols/googlescopes
// * Google_Service_Oauth2::USERINFO_EMAIL = https://www.googleapis.com/auth/userinfo.email
// * Google_Service_Oauth2::USERINFO_PROFILE = https://www.googleapis.com/auth/userinfo.profile
// * $gclient->addScope(['https://www.googleapis.com/auth/userinfo.email', Google_Service_Oauth2::USERINFO_PROFILE]);
$gclient = new Google_Client();
$gclient->setAuthConfig('credentials_google_oauth.json');
$gclient->setAccessType('offline'); // offline access
$gclient->setIncludeGrantedScopes(true); // incremental auth
$gclient->addScope([Google_Service_Oauth2::USERINFO_EMAIL, Google_Service_Oauth2::USERINFO_PROFILE]);
$gclient->setRedirectUri(''); // 寫憑證設定：「已授權的重新導向 URI 」的網址

$google_login_url = $gclient->createAuthUrl(); // 取得要點擊登入的網址

// 登入後，導回來的網址會有 code 的參數
if (isset($_GET['code']) && $gclient->authenticate($_GET['code'])) {
    $token = $gclient->getAccessToken(); // 取得 Token

    $gclient->setAccessToken($token); // 設定 Token

    $oauth = new Google_Service_Oauth2($gclient);
    $profile = $oauth->userinfo->get();

    $uid = $profile->id; // Primary key
    print_r($profile); // 自行取需要的內容來使用囉~
} else {
    // 直接導向登入網址
    header('Location: ' . $google_login_url);
    exit;
}
?>