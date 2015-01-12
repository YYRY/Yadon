<?php

//ヘッダー読み込み
include "../../header.php";

if( isset($_POST["mail"]) ){
	$mail = $_POST["mail"];
}else{
	header( "location:regist.php" );
	exit;
}
$pass = $_POST["pass"];
$c1 = $_POST["c1"];
$c2 = $_POST["c2"];
$nenn = $_POST["nenn"];
$gatu = $_POST["gatu"];
$c3 = $_POST["c3"];


/*****************
* DB接続設定
*****************/
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";
$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
mysql_query("SET NAMES utf8");
mysql_select_db("iw32",$con);

//ユーザ数をカウント
$sql ="
select count(*)
from customer_m
";
$yuza_count = 0;
$res = mysql_query($sql,$con);
while($row = mysql_fetch_array($res)){
	$yuza_count = $row[0];
}
$yuza_count++;

$sql ="
INSERT INTO `iw32`.`customer_m` (
 `customer_id` ,
`customer_name` ,
`pass` ,
`mail` ,
`sei` ,
`seinenn` ,
`registrant_id` ,
`registrant_date` 
)
VALUES (
 '$yuza_count', NULL , '$pass' , '$mail', NULL , NULL , '', ''
)";
$res = mysql_query($sql,$con);


?>

<!DOCTYPE html>
<html>
	<head>
	<title>映画予約会員登録完了</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/reserved/insert.css" rel="stylesheet" type="text/css">

	<!--  js  -->

	</head>
<body>

<article>


<h1>予約完了しました</h1>
<p>
    会員登録と映画予約が完了しました。
    登録されたアドレス宛に映画予約の際に使用できるQRコードが送られました。<br />
    映画鑑賞の際にチケット代わりになります。
</p>


</article>

<?php
include '../../footer.php';
?>


</body>
</html>