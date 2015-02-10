<?php

//直接リンクした場合
if( !isset($_GET["movie"]) ){
	header("location:data_list.php");
	exit;
}
else{
	$movie_id = $_GET["movie"];
}

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

echo "<h2>予約状況</h2>";

//映画名取得
$sql ="
SELECT
  title
FROM
  movie_m
WHERE
  movie_id = '".$movie_id."'
";
$res = mysql_query( $sql , $con );
while( $row = mysql_fetch_array( $res ) ){
	echo "<h2>".$row[0]."</h2>";
}


//選択した映画名と予約状況を取得
$sql = "
SELECT
  cu.sei
, cu.seinenn
FROM
  movie AS mo
JOIN
  movie_m AS mm
ON
  mo.movie_id = mm.movie_id
JOIN
  customer_m AS cu
ON
  mo.customer_id = cu.customer_id
WHERE
  mm.movie_id = '".$movie_id."'
";
$res = mysql_query( $sql , $con );

$all_count = 0;
$count1 = 0;
$count2 = 0;
echo "<table>";
while( $row = mysql_fetch_array( $res ) ){
	echo "<tr><td>".$row[0]."</td>";
	echo "<td>".$row[1]."</td></tr>";
	$all_count++;

	//性別判定
	if($row[0] == "男"){
		$count1++;
	}
	else{
		$count2++;
	}
}
echo "</table>";
echo "男性：".$count1."件<br />";
echo "女性：".$count2."件<br />";
echo "全".$all_count."件<br />";
?>

<!DOCTYPE html>
<html>
	<head>
	<title>予約状況</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	</head>
<body>


<a href="pdf2.php?movie=<?= $movie_id ?>">
	<img src="../img/output/button.png" alt="PDF化">
</a>
<a href="data_list.php">戻る</a>


</body>
</html>