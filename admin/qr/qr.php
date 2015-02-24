<!DOCTYPE html>
<html>
<head>
<title>予約確認</title>
<meta charset="utf8">
</head>
<body>

<h1>QRチケット</h1>

<?php
//DB接続に使う変数
$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";
//DBMS(MySQL)に接続
$con = mysql_connect($host_name , $dbms_user , $dbms_pass);
//文字化けを解消（無理やりなやり方）
mysql_query("SET NAMES utf8");
//データベースを選択
mysql_select_db( "iw32" , $con );

$flg1 = false;

//QR用顧客IDと映画ID取得
if(isset( $_GET["c_id"] ) ){

	$c_id = $_GET["c_id"];

	$sql = "
	SELECT customer_name
	FROM customer_m
	WHERE customer_id = ".$c_id."
	";
	$res = mysql_query( $sql , $con );

	while( $row = mysql_fetch_array( $res ) ){
		echo "顧客番号：".$c_id."<br />";
		echo "顧客名　：".$row[0];
		$flg1 = true;
	}
	if($flg1 == false){
		header("location:../index.php");
		exit;
	}
}
else{
	header("location:../index.php");
	exit;
}

?>

<br /><br />
<form action="check.php" method="post">
	<input type="hidden" name="c_id" value="<?= $c_id ?>">
	顧客パスワード：<input type="c_pass" name="c_pass"><br />
	従業員ID：<input type="text" name="e_id"><br />
	パスワード：<input type="text" name="e_pass"><br />
	<input type="submit" value="予約状況確認">
</form>

</dody>
</html>