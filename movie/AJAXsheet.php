<?php

//セッションのphp読み込み
include "../include_session/session.php";

$td = $_POST["td"];
$y = $_POST["y"];
$c_id = $_POST["c_id"];
$mov = $_POST["mov"];
$day = $_POST["day"];
$time = $_POST["time"];

$pattern = "";


$flg1 = false;
$flg2 = false;


//列の抽出（AとかBとか）
$td1 = substr( $td , 0 , 1 );

//席x座標の抽出（1とか2とか）
$td2 = substr( $td , 2 , 2 );



///// DB接続設定 /////
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
mysql_query("SET NAMES utf8");
mysql_select_db( "iw32" , $con );
///// DB接続設定終わり /////


/************************************
* ユーザーが予約済みの場合予約解除
************************************/
$sql = "
select
  *
from
  movie
where
  customer_id = '$c_id' AND
  watch_day = '$day' AND
  watch_time = '$time' AND
  x = '$td2' AND
  retu = '$td1'
";
$res = mysql_query($sql,$con);
while($row = mysql_fetch_array($res)){
	$flg1 = true;
}


/******************************
* 他ユーザーが予約済みの場合
******************************/
$sql = "
select
  *
from
  movie
where
  movie_id = '$mov' AND
  customer_id <> '$c_id' AND
  watch_day = '$day' AND
  watch_time = '$time' AND
  x = '$td2' AND
  retu = '$td1'
";
$res = mysql_query($sql,$con);
while($row = mysql_fetch_array($res)){
	$flg2 = true;
}


//削除
if($flg1){
	$sql="
	DELETE FROM iw32.movie
	WHERE
	movie.customer_id = '$c_id' AND
	watch_day = '$day' AND
	watch_time = '$time' AND
	movie.x = '$td2' AND
	movie.retu = '$td1'
	";
	$res = mysql_query($sql,$con);
	$pattern = "削除";
}
//他ユーザー登録済み
if($flg2){
	$pattern = "登録済み";
}
//登録
if($flg1 == false && $flg2 == false){
	$sql ="
	INSERT INTO `iw32`.`movie` (
	`customer_id` ,
	`movie_id` ,
	`cinema_id` ,
	`screen_id` ,
	`seat_id` ,
	`x` ,
	`y` ,
	`retu` ,
	`watch_day` ,
	`watch_time` ,
	`purchaser_info_id` ,
	`reservation_date` ,
	`flag` ,
	`registrant_id` ,
	`registered_date` 
	)
	VALUES (
	 '$c_id', '$mov', '1', '1', '1', '$td2', '$y' , '$td1' , '$day', '$time', NULL , '', '', '', ''
	)";
	$res = mysql_query($sql,$con);
	$pattern = "登録";
}

mysql_close($con);


echo $pattern;

?>