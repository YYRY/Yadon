<?php

include "../header.php";


///// DB接続設定 /////
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
mysql_query("SET NAMES utf8");
mysql_select_db( "iw32" , $con );
///// DB接続設定終わり /////

//配列初期化用
$sql="select * from seat2_1";

$sql="
DELETE FROM `iw32`.`movie` WHERE `movie`.`customer_id` = '$c_id' AND `movie`.`movie_id` = 1 AND `movie`.`cinema_id` = 1 AND `movie`.`screen_id` = 1
";


$res = mysql_query($sql,$con);


?>

<!DOCTYPE html>
<html>
	<head>
	<title>座席予約終了</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/reserve/insert.css" rel="stylesheet" type="text/css">
	<!--  js  -->

	</head>
<body>


予約終わり<br />
QRコードをメールで出す<br /><br />






<?php
include('../footer.php');
?>