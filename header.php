<?php
//print_r($_SERVER);

// 表示ルートの取得
$root     = 'http://' . $_SERVER['HTTP_HOST'] . '/IW32/front';

// 表示ディレクトリの取得
$dir      = basename(dirname($_SERVER['SCRIPT_FILENAME'])) . '/';
if ( 'front/' === $dir ) {
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
		<link rel="icon"                         type="image/png" href="<?=$root ?>/img/icon/apple-touch-icon-precomposed.png">
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

		<title>ハルシネマ</title>
	</head>
	<body>
		<!-- ヘッダー -->
		<header>
			<h1><img src="<?=$root ?>/img/logo.png" alt="ハルシネマ"></h1>

			<ul>
				<li><a href="" title="お問い合わせ"><img src="<?=$root ?>/img/icon/お問い合わせ.png" width="50" height="50" alt="お問い合わせ"></a></li>
				<li><a href="" title="Q &amp; A"><img src="<?=$root ?>/img/icon/Q&A.png" width="50" height="50" alt="Q &amp; A"></a></li>
				<li><a href="" title="サイトマップ"><img src="<?=$root ?>/img/icon/sitemap.png" width="50" height="50" alt="サイトマップ"></a></li>
				<li><a href="" title="ログイン"><img src="<?=$root ?>/img/icon/ログイン.png" width="50" height="50" alt="ログイン"></a></li>
			</ul>
		</header>

		<!-- ナビゲーション -->
		<nav>
			<ul>
<li id="menu1"><a href="" title="お問い合わせ"></a></li>
				<li id="menu2"><a href="" title="お問い合わせ">お知らせ</a></li>
				<li id="menu3"><a href="" title="お問い合わせ">上映予定作品一覧</a></li>
				<li id="menu4"><a href="" title="お問い合わせ">料金</a></li>
				<li id="menu5"><a href="" title="お問い合わせ">割引サービス</a></li>
				<li id="menu6"><a href=""title="お問い合わせ">アクセス方法</a></li>
			</ul>
		</nav>


