<?php

$c_id = $_POST["c_id"];
$e_id = $_POST["e_id"];
$e_pass = $_POST["e_pass"];
$m_id = $_POST["m_id"];
$date = $_POST["date"];
$retu = $_POST["retu"];
$x = $_POST["x"];

/*
if( mb_strlen($c_id)==0 || mb_strlen($m_id)==0 ){
	header("location:qr.php?c_id=".$c_id."");
	exit;
}*/

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


//従業員情報チェック
$sql = "
SELECT
  customer_id
, pass
FROM
  customer_m
";
$res = mysql_query( $sql , $con );
while( $row = mysql_fetch_array( $res ) ){
	if($row[0] == $c_id){
		$c_pass = $row[1];
	}
}


//映画情報チェック
$sql = "
SELECT
  customer_id
, movie_id
, watch_day
, retu
, x
FROM
  movie
";
$res = mysql_query( $sql , $con );
while( $row = mysql_fetch_array( $res ) ){
	if($row[0] == $c_id){
		if($row[1] == $m_id){
			if($row[2] == $date){
				if($row[3] == $retu && $row[4] == $x){
					$flg1 = true;
				}
			}
		}
	}
}


?>

<!DOCTYPE html>
<html>
<head>
<title>予約確認</title>
<meta charset="utf8">
</head>
<body>

<h1>QRチケット</h1>

<?php
if($flg1){
	//予約情報の削除
	$sql ="DELETE FROM `iw32`.`movie` WHERE `movie`.`customer_id` = ".$c_id." AND `movie`.`movie_id` = ".$m_id." AND `movie`.`x` = ".$x." AND `movie`.`watch_day` = ".$date."";

	$res = mysql_query( $sql , $con );
	
	echo "入場可能です。";
	echo $retu."列　".$x."番の席です<br /><br />";

}else{
	echo "通信エラー";
}

?>

<form action="check.php" method="post">
    <input type="hidden" name="c_id" value="<?= $c_id ?>">
    <input type="hidden" name="c_pass" value="<?= $c_pass ?>">
    <input type="hidden" name="e_id" value="<?= $e_id ?>">
    <input type="hidden" name="e_pass" value="<?= $e_pass ?>">
	<input type="submit" value="映画選択へ戻る">
</form>


</dody>
</html>