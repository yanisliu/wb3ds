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
<div class="doc">
    <div class="header">
        <h1 class="title">Weibo for Nintendo 3ds</h1>
    </div><!-- /header -->

    <div class="content">
        <h2>Hi, <em class="username"><?=$user_message['screen_name']?></em>! <a href="logout.php">Logout?</a></h2>
        <form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>*Please chose a picture.</dt>
                <dd>
                    <input type="file" name="image" />
                </dd>
                <dt>*Please input the comment.</dt>
                <dd>
                    <input class="comment" type="text" name="comment" />
                </dd>
                <dt>Please select a tag.</dt>
                <dd>
                    <input id="tag" type='checkbox' name='tag' value="動物の森" />
                    <label for="tag">動物の森</label>
                </dd>
            </dl>
            <div class="submit">
                <input type="image" src="img/send_weibo.png" value="Send" />
            </div>
        </form>
<?php
if ( isset($_REQUEST['comment']) ) {
    if ($_FILES['image']['name'] == ""){
        echo '<p class="error">Please chose a picture!</p>';
    } else if ($_REQUEST['comment'] == "") {
        echo '<p class="error">Please input the comment!</p>';
    } else {
        if ($_REQUEST['tag'] != ""){
            $tag = ' #'.$_REQUEST['tag'].'# ';
        } else {
            $tag = '';
        }
        $ret = $c->upload( '#wb3ds# '.$tag.$_REQUEST['comment'], $_FILES['image']['tmp_name']);
        if ( isset($ret['error_code']) && $ret['error_code'] > 0 ) {
            echo "<p>Sending failure,error：{$ret['error_code']}:{$ret['error']}</p>";
        } else {
            echo '<script type=text/javascript>window.location.href="weibo.php"</script>';
            // header("Location: weibo.php");
            // exit;
        }
    }
}
?>
    </div><!-- /content -->

    <div class="footer">
        <div><a href="http://wb3ds.sinaapp.com">home</a><a href="https://github.com/yanisliu/wb3ds/issues" target="_blank">question</a><a href="https://github.com/yanisliu/wb3ds" target="_blank">github</a></div>
        <div>
            <p>If you use twitter, try <a href="http://tw3ds.com/login.php">tw3ds</a></p>
            <p>Theme by <a href="http://tw3ds.com/login.php">tw3ds</a></p>
        </div>
        <a href="http://wb3ds.sinaapp.com">- wb3ds.sinaapp.com - </a>
    </div><!-- /footer -->
</div><!-- /page -->
</body>
</html>
