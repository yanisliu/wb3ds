<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

if (!empty($_SESSION['token']) && $_SESSION['token']['access_token']){
    header("Location: index.php");
    exit;
}

$o = new SaeTOAuthV2( WB_AKEY , WB_SKEY );

$code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );

?>
<!DOCTYPE html>
<html>
<head>
    <title>Weibo for Nintendo 3ds</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="css/page.css">
</head>
<body>
<div class="doc">
    <div class="header">
        <h1 class="title">Weibo for Nintendo 3ds</h1>
    </div><!-- /header -->

    <div class="content">
        <p>Weibo for Nintendo 3ds</p>
        <p>Theme by <a href="http://tw3ds.com/login.php">tw3ds</a></p>
        <p>Thanks @nihimoto (Twitter)</p>
        <p class="btn"><a href="<?=$code_url?>"><img src="img/weibo_login.png" alt="login" border="0" /></a></p>
    </div><!-- /content -->

    <div class="footer">
        <div><a href="http://wb3ds.sinaapp.com">home</a><a href="https://github.com/yanisliu/wb3ds/issues">question</a><a href="https://github.com/yanisliu/wb3ds">github</a></div>
        <div>
            <p>If you use twitter, try <a href="http://tw3ds.com/login.php">tw3ds</a></p>
            <p>Theme by <a href="http://tw3ds.com/login.php">tw3ds</a></p>
        </div>
        <a href="http://wb3ds.sinaapp.com">- wb3ds.sinaapp.com - </a>
    </div><!-- /footer -->
</div><!-- /page -->
</body>
</html>