<?php

//セッションフラグ
$s_flg = false;

//セッションスタート
@session_start();

//セッションが無い状態
if( !isset( $_SESSION["c_id"] ) || $_SESSION["c_id"] == null ){
	$c_id = "";
}
//セッションがあった
else{
	$c_id = $_SESSION["c_id"];
	$s_flg = true;
}



// 表示ルートの取得
$root     = 'http://' . $_SERVER['HTTP_HOST'] . '/iw32/Yadon';

// 表示ディレクトリの取得
$dir      = basename(dirname($_SERVER['SCRIPT_FILENAME'])) . '/';
if ( 'Yadon/' === $dir ) {
	$dir = '';
}

// ページ独自のスタイルやスクリプト用の
$filename = basename($_SERVER['SCRIPT_FILENAME'], '.html');
$filename = basename($filename, '.php');

?>
<!DOCTYPE html>
<html lang="ja">
	<head>

		
		<meta charset="utf-8">
		<!-- SEO対策 -->
		<meta name="keywords"    content="ハルシネマ東京">
		<meta name="description" content="ハルシネマのサイトです">

		<!-- ファビコン -->
		<link rel="icon"                         type="image/png" href="<?=$root ?>/img/icon/favicon.png">
		<link rel="apple-touch-icon"             type="image/png" href="<?=$root ?>/img/icon/apple-touch-icon-precomposed.png">
		<link rel="apple-touch-icon-precomposed" type="image/png" href="<?=$root ?>/img/icon/apple-touch-icon-precomposed.png">

		<!--  css  -->
		<link rel="stylesheet" href="<?=$root ?>/css/common.css">
		<link rel="stylesheet" href="<?=$root ?>/css/<?=$dir ?><?=$filename ?>.css">

		<!--  js  -->
		<script src="<?=$root ?>/js/jquery/jquery-2.1.1.min.js"></script>
		<script src="<?=$root ?>/js/<?=$dir ?><?=$filename ?>.js"></script>

		<!-- IE8, 9のHTML5 CSS 3対策 -->
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="./css/ie.css">
			<script src="<?=$root ?>/js/ie/html5shiv.min.js"></script>
			<script src="http://s3.amazonaws.com/nwapi/nwmatcher/nwmatcher-1.2.5-min.js"></script>
			<script src="<?=$root ?>/js/ie/selectivizr-min.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
		<![endif]-->

		<title>HAL CINEMAS</title>
		<script src="js/jquery/jquery-1.11.1.min.js"></script>
<script>
$(function(){

$('nav li a').hover(
        function(){  
            $(this).stop().animate({'opacity' : '0.5'}, 500);
        },
        function(){
            $(this).stop().animate({'opacity' : '1'}, 1000);
        }
);
});
</script>
	</head>
	<body>
		<!-- ヘッダー -->
		<header>
			<h1><a href="<?=$root ?>/index.php" title="logo"><img src="<?=$root ?>/img/logo.png" alt="ハルシネマ"></a></h1>

			<ul>
				<li><a href="<?=$root ?>/regist/nonregist/regist.php" title="新規登録">新規登録<!--<img src="<?=$root ?>/img/icon/ログイン.png" width="50" height="50" alt="お問い合わせ">--></a></li>
				<li><a href="<?=$root ?>/mypage/mypage.php" title="マイページ"><img src="<?=$root ?>/img/icon/mypage.png" width="50" height="50" alt="お問い合わせ"></a></li>
				<li><a href="<?=$root ?>/inquiry/inquiry.php" title="お問い合わせ"><img src="<?=$root ?>/img/icon/お問い合わせ.png" width="50" height="50" alt="お問い合わせ"></a></li>
				<li><a href="<?=$root ?>/q&a/q&a.php" title="Q &amp; A"><img src="<?=$root ?>/img/icon/Q&A.png" width="50" height="50" alt="Q &amp; A"></a></li>
				<li><a href="<?=$root ?>/sitemap/sitemap.php" title="サイトマップ"><img src="<?=$root ?>/img/icon/sitemap.png" width="50" height="50" alt="サイトマップ"></a></li>

                <?php
				if( strlen($c_id) == 0 || $c_id == "" ){ ?>
				<li>
                	<a href="<?=$root ?>/login/login.php" title="ログイン">
                		<img src="<?=$root ?>/img/icon/ログイン.png" width="50" height="50" alt="ログイン">
                    </a>
                </li>
                <?php }else{ ?>
				<li>
                	<a href="<?=$root ?>/logout/logout.php" title="ログアウト">
                		<img src="<?=$root ?>/img/icon/ログアウト.png" width="50" height="50" alt="ログアウト">
                    </a>
                </li>
                <?php } ?>


			</ul>
		</header>

		<!-- ナビゲーション -->
		<nav>
			<ul>
<li id="menu1"><a href="<?=$root ?>/movie/list.php" title="上映作品一覧">上映作品一覧</a></li>
				<li id="menu2"><a href="<?=$root ?>/news/news.php" title="お知らせ" value="1">お知らせ</a></li>
				<li id="menu3"><a href="<?=$root ?>/movie_plan/list.php" title="上映予定作品一覧">上映予定作品一覧</a></li>
				<li id="menu4"><a href="<?=$root ?>/price/list.php" title="料金">料金</a></li>
				<li id="menu5"><a href="<?=$root ?>/sale/list.php" title="割引サービス">割引サービス</a></li>
				<li id="menu6"><a href="<?=$root ?>/access/list.php" title="アクセス方法">アクセス方法</a></li>
			</ul>
		</nav>


