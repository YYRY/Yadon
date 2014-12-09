<?php

//ヘッダー読み込み
include "../include_session/session.php";
include "../header.php";

/*------------------------------*
* ニュース（お知らせ）表示用SQL *
*-------------------------------*/
//DB接続に使う変数（ユーザー名とかパスワードとか）
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

//DBMS(MySQL)に接続
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);

//文字化けを解消（無理やりなやり方）
mysql_query("SET NAMES utf8");

//データベースを選択
mysql_select_db( "iw32" , $con );

//SQL select全件抽出（降順に出力）
$sql = "SELECT * FROM notice ORDER BY notice_id DESC";

//SQL実行
$res = mysql_query( $sql , $con );		//$resには「成功 true」か「失敗 false」が入る
  
//DB接続切断
mysql_close( $con );
?>

<!DOCTYPE html>
<html>
	<head>
	<title>HALシネマ</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/news/news.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="../js/news/news.js"></script>
    <script src="../js/jquery/jquery-1.10.4-ui.min.js"></script>
    <script src="../js/jquery/jquery-1.11.1.min.js"></script>
    
    <!--ローカルで使用しない場合のjQuery
    	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    -->
	</head>
<body>

<!--
notice.sqlをiw32データベースにインポートしてから参照
imgの詳細ボタンは適当に作ったので、後のデザインによって変更予定
-->

	<!--ページ内部開始-->
    <article class="main-contents">

		<? while( $row = mysql_fetch_array( $res ) ){ ?>

			<!--ニュース開始-->
			<article class="NEWS">

				<!--ニュース画像-->
				<div class="New_img">
					<img src="../img/news/<?= $row["notice_id"] ?>.png" width="299px" height="180px" alt="<? echo $row[ "title" ]; ?>">
				</div>

				<!--ニュース内要-->
				<div class="New_contents">
                	<h1>
						<span class="New_title"><? echo $row[ "title" ]; ?></span>
						<span class="New_day"><? echo $row[ "registered_date" ]; ?></span>
                    </h1>
					<p><? echo $row[ "summary" ]; ?></p>
					<img src="../img/news/detail1.png" width="90px" height="35px" alt="詳細" class="detail">
				</div>

			</article>
			<!--ニュース終了-->

		<? } ?>

	</article>

    <!--ページ内部終了-->
	<footer>
		<p><small>Copyright IH12B334	kaito shidara ALLRIGHTS RESERVED.</small>
		</p>
	</footer>
</body>
</html>