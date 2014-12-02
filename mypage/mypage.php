<?php
include '../header.php';
session_start();
	$CustmerId = 100;
	//セッションにでーたを格納
	//$CustmerId = $_SESSION["CustmerId"];
	$_SESSION["CustmerId"] = $CustmerId;
?>
<!--DOCTYPE html>
<html>
	<head>
	<title>マイページ｜HALシネマ</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!- ＳＥＯ対策　
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!- スマホで見るなら ->
	<!-  css  ->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/index.css" rel="stylesheet" type="text/css">
	<!-  js  ->
	<script src="../js/script.js"></script>
	</head>
<body>-->
	<article>
		<section class="left-cont">
			<!-- <ul> 
				<li><a href="">お問い合わせ</a></li>
				<li><a href="">Q &amp; A</a></li>
				<li><a href="">サイトマップ</a></li>
				<li><a href="">ログイン</a></li>
			</ul>-->
			<div><a href="user_info/user.html">ユーザ情報</a></div>
			<div><a href="cregit_info/cregit.php">クレジットカード情報</a></div>
			<div><a href="mail_info/mail.html">メルマガ登録・変更</a></div>
		</section>
		<section class="right-cont">
			<div>購入履歴</div>
			<p>00/00:○○○を購入しました</p>
			<p>00/00:○○○を購入しました</p>
			<p>00/00:○○○を購入しました</p>
		</section>
		<div class="cl"> </div>
	</article>
<?php
include '../footer.php';
?>