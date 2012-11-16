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
<div>
    <div class="doc">
        <div class="header">
            <h1 class="title">Weibo for Nintendo 3ds</h1>
        </div><!-- /header -->

        <div class="content">
            <p>このサイトはニンテンドー3DSから画像付きツイートをかんたんに投稿するためのツールです。（非公式）</p>
            <p>ニンテンドー3DSのインターネットブラウザーでこのサイトにアクセスすれば、いつでもニンテンドー3DSの画像をツイッターに投稿することができます。</p>
            <p>もちろん、どなたでも無料でご利用いただけます。</p>
            <p class="btn"><a href="<?=$code_url?>"><img src="img/weibo_login.png" alt="login" border="0" /></a></p>
        </div><!-- /content -->

        <div class="footer">
            <a data-role="button" data-theme="b" href="http://wb3ds.sinaapp.com">- wb3ds.sinaapp.com - </a>
        </div><!-- /footer -->
    </div>
</div><!-- /page -->
</body>
</html>