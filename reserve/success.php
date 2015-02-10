<?php

include "../header.php";


//QR用顧客IDと映画ID取得
if(isset( $_POST["c_id"] ) && isset( $_POST["mov"] ) ){
	$c_id = $_POST["c_id"];
	$mov = $_POST["mov"];
}else{
	header( "location:../index.php" );
	exit;
}


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

/*
$sql="
DELETE FROM `iw32`.`movie` WHERE `movie`.`customer_id` = '$c_id' AND `movie`.`movie_id` = '$mov' AND `movie`.`cinema_id` = 1 AND `movie`.`screen_id` = 1";
*/


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
	<link href="../css/reserved/success.css" rel="stylesheet" type="text/css">
	<!--  js  -->
	<script type="text/javascript" src="../js/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="../js/qr/jquery.qrcode.min.js"></script>
	</head>

<script type="text/javascript">
$(document).ready(function(){
     $('#qr').qrcode({		//demo2:幅や高さを指定する場合
         width:100,				//QRコードの幅
         height:100,			//QRコードの高さ
         text:'http://hal.ovdesign.jp/md31/fujita/iw32/qr.php?c_id=<?= $c_id ?>'			//QRコードの内容
   });
});
</script>

<body>


<?php
/***************************
* メールの送信
***************************/
//文字コード設定
mb_language("Japanese");
mb_internal_encoding("UTF-8");
		
//*環境設定*************************************
//件名
$subject = "映画予約完了";
//管理人メールアドレス(宛先)
$to = "fujita1@localhost";
//**********************************************

//**POSTデータ受け取り**************************
//差出人メールアドレス格納
$header = "From: fujita1@localhost";
		
//本文格納
$body = "
映画予約完了しました。\n
マイページのQRコードを保存して映画館職員に見せるか、映画館職員に以下のURLを見せてください。
<http://hal.ovdesign.jp/md31/fujita/iw32/qr.php?c_id=".$c_id.">
";// <>で囲むとリンクと認識される

//メール送信
if(mb_send_mail($to,$subject,$body,$header)){
	
}else{
	$mes = "メール送信に失敗しました<br /><br />";
}
?>





<div id="box">
<p>予約完了しました</p>
<br />
予約完了メールと予約確認用メールを送信しました。大切に保管してください。<br />
以下のQRコード画像を鑑賞日に映画館の従業員に見せることで、チケットの変わりにすることが出来ます。<br />
画像を見せることが出来ない場合でも、メールアドレスで入場することが出来ます。<br /><br />

<div id="QRarea">
	<div id="qr"></div>
</div>
</div>








<?php
include('../footer.php');
?>