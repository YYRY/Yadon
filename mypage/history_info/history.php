<?php
	/*********************************
	*************  初期化  ***********
	*********************************/
	$customer_id="";
	$message = "";
	/*session_start();
	if($_SESSION["customer_id"] == null || !isset($_SESSION["customer_id"])){
		header("location:../../index.php");
		exit;
	}else if{
		//セッションデータの取得
		$customer_id=$_SESSION["customer_id"];
	}*/
	
	$color ="color:white;";

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);

	//sql文作成
	$sql = "SELECT purch_day ,title from buy_history where customer_id LIKE '0'";//$customer_id

	//sql実行
	$res = mysql_query($sql , $con);
	$henkou = mysql_affected_rows();
	//DB切断
	mysql_close($con);
?>
<!--DOCTYPE html>
<html>
	<head>
	<title>購入履歴|マイページ|HALシネマ</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!- ＳＥＯ対策　->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!- スマホで見るなら ->
	<!-  css  ->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/index.css" rel="stylesheet" type="text/css">
	<!- js  ->
	<script src="js/script.js"></script>
	</head>
<body>-->
<?php
include '../../header.php';
?>
	<article>
		<p><span style=<?=$color?>><?=$message?></span></p>
		<section>
			<h1>購入履歴</h1>
				<div id="buy_naka">	
				<table class="his_ta">
					<tr>
						<th>購入日</th>
						<th>映画タイトル</th>
					</tr>
					<tr>			
<?php
			while($row = mysql_fetch_array($res)){
				//echo "<td>".$row["customer_id"]."</td>";
				//echo "<td>".$row["customer_name"]."</td>";
				echo "<td>".$row["purch_day"]."</td>";
				//echo "<td>".$row["movie_id"]."</td>";
				echo "<td>".$row["title"]."</td>";
				echo "</tr>";
			}
			if($henkou ==0){
				$message = "購入履歴がありません";
				$color ="color:red;";
			}
?>	
				</table>
			</div>
			<a href="../mypage.php">マイページに戻る</a><br>
		</section>
	</article>
<?php
include '../../footer.php';
?>