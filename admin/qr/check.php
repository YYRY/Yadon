<?php

$c_id = $_POST["c_id"];
$c_pass = $_POST["c_pass"];
$e_id = $_POST["e_id"];
$e_pass = $_POST["e_pass"];

if( mb_strlen($c_id)==0 || mb_strlen($c_pass)==0 || mb_strlen($e_id)==0 || mb_strlen($e_pass)==0 ){
	header("location:qr.php?c_id=".$c_id."");
	exit;
}

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
$flg2 = false;


//従業員情報チェック
$sql = "
SELECT
  employee_id
, pass
FROM
  employee
";
$res = mysql_query( $sql , $con );
while( $row = mysql_fetch_array( $res ) ){
	if($row[0] == $e_id && $row[1] == $e_pass){
		$flg1 = true;
	}
}

//顧客パスワードチェック
$sql = "
SELECT
  customer_id
, pass
FROM
  customer_m
";
$res = mysql_query( $sql , $con );
while( $row = mysql_fetch_array( $res ) ){
	if($row[0] == $c_id && $row[1] == $c_pass){
		$flg2 = true;
	}
}

//どちらかでも合致しなかったら
if($flg1 == false || $flg2 == false){
	header("location:qr.php?c_id=".$c_id."");
	exit;
}


?>

<!DOCTYPE html>
<html>
<head>
<title>予約最終確認</title>
<meta charset="utf8">
</head>
<body>

<h1>QRチケット</h1>


<?php

$sql = "
SELECT
  c.customer_name
, mm.movie_id
, mm.title
, m.retu
, m.x
, watch_day
FROM
  customer_m AS c
JOIN
  movie AS m
ON
  c.customer_id = m.customer_id
JOIN
  movie_m AS mm
ON
  m.movie_id = mm.movie_id
WHERE
  c.customer_id = ".$c_id."
";

$res = mysql_query( $sql , $con );
$count = 0;
while( $row = mysql_fetch_array( $res ) ){

	if($count==0){
		echo "「".$row[0]."」さん<br />";
	}

	//10月以降
	if( mb_strlen($row[5]) == 4 ){
		$month = substr($row[5], 0, 2);
	}else{
		$month = substr($row[5], 0, 1);
	}

	$day = substr($row[5], -2, 2);

	echo $row[2]."　　".$month."月".$day."日　".$row[3]."列　".$row[4]."番
	<form action='comp.php' method='post'>
	<input type='hidden' name='c_id' value='".$c_id."'>
	<input type='hidden' name='m_id' value='".$row[1]."'>
	<input type='hidden' name='date' value='".$month.$day."'>
	<input type='hidden' name='retu' value='".$row[3]."'>
	<input type='hidden' name='x' value='".$row[4]."'>

	<input type='hidden' name='c_pass' value='".$c_pass."'>
	<input type='hidden' name='e_id' value='".$e_id."'>
	<input type='hidden' name='e_pass' value='".$e_pass."'>

	<input type='submit' value='決定'>
	</form>
	";
	$count++;
}

?>

<a href="qr.php?c_id=<?= $c_id ?>">ログイン画面に戻る</a>

</dody>
</html>