<?php
session_start();

include_once( 'config.php' );
include_once( 'saetv2.ex.class.php' );

if (!$_SESSION['token']['access_token']){
    header("Location: login.php");
    exit;
}

$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $_SESSION['token']['access_token'] );
$uid_get = $c->get_uid();
$uid = $uid_get['uid'];
$user_message = $c->show_user_by_id( $uid);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Weibo for Nintendo 3ds</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/page.css">
</head>
<body>
<div>
    <div class="doc">
        <div class="header">
            <h1 class="title">Weibo for Nintendo 3ds</h1>
        </div><!-- /header -->

        <div class="content">
            <h2>Hi, <em class="username"><?=$user_message['screen_name']?></em>!</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <dl>
                    <dt>Please chose a picture.</dt>
                    <dd>
                        <input type="file" name="image" />
                    </dd>
                    <dt>Please input the comment.</dt>
                    <dd>
                        <input class="comment" type="text" name="comment" />
                    </dd>
                </dl>
                <div class="submit">
                    <input type="image" src="img/send_weibo.png" value="Send" />
                </div>
            </form>
<?php
if ( isset($_REQUEST['comment']) ) {
    $ret = $c->upload( '#wb3ds# '.$_REQUEST['comment'], $_FILES['image']['tmp_name']);
    if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
        echo "<p>Sending failure,error：{$ret['error_code']}:{$ret['error']}</p>";
    } else {
        echo '<script type=text/javascript>window.location.href="weibo.php"</script>';
    }
}
?>
        </div><!-- /content -->

        <div class="footer">
            <ul>
                <li><a href="http://wb3ds.sinaapp.com"></a></li>
            </ul>
            <a data-role="button" data-theme="b" href="http://wb3ds.sinaapp.com">- wb3ds.sinaapp.com - </a>
        </div><!-- /footer -->
    </div>
</div><!-- /page -->
</body>
</html>
