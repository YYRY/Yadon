<?php
include "../header.php";


//movie_id取得
if( isset( $_GET["mov"] ) ){
	$mov = $_GET["mov"];
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

?>

<!DOCTYPE html>
<html>
	<head>
	<title>座席予約確認</title>
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

<div id="yoyaku">
<a href="../movie/detail.php?mov=<?= $mov ?>">座席選択に戻る</a>
<?php
//予約席
$sql="
select retu , x
from movie
where seat_id = 1 and customer_id = '$c_id'
order by retu , x
";

$res = mysql_query($sql,$con);

$count = 0;

while($row = mysql_fetch_array($res)){
	echo $row[0];
	echo "-";
	echo $row[1];
	echo "<br />";
	$count++;
}
echo "全".$count."席<br />";
echo $count*1800 ."円<br />";

?>

<form action="success.php" method="post">
	<input type="hidden" name="c_id" value="<?= $c_id ?>">
	<input type="hidden" name="mov" value="<?= $mov ?>">
    <input type="submit" value="以上の席で予約する">
</form>


</div>



<?php
include('../footer.php');
?>