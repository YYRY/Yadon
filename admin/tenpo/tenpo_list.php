<?php

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


//SQL movie_idを件数で出力（映画別売り上げ用）
$sql = "
SELECT
  s.screen_name
, m.W
, m.H

FROM screen AS s

JOIN seat_m AS m
ON s.seat_id = m.seat_id";

//SQL実行
$res = mysql_query( $sql , $con );

//DB接続切断
mysql_close( $con );

$count1 = 0;

//抽出
while( $row = mysql_fetch_array( $res ) ){
	//スクリーン名・縦横
	$s[$count1] = $row[0];
	$x[$count1] = $row[1];
	$y[$count1] = $row[2];
	$count1++;
}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>映画館情報一覧</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/tenpo/tenpo_list.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="js/script.js"></script>

	</head>
<body>


	<article>

		<table>
			<tr>
				<th>映画館名</th>
				<th class="screen">スクリーン名</th>
				<th class="seat">座席</th>
			</tr>

			<tr>
				<td rowspan="8"><a href="permute/info.php?name=HALシネマ東京">HALシネマ東京</a></td>
				<?php
					//DBの1行目抽出
					echo "<td class='screen'><a href='permute/screen.php?screen=$s[0]'>" , $s[0] , "</a></td>";
					echo "<td class='seat'>" , $x[0] , "×" , $y[0] , "</td></tr>";

					//DBの2行目以降抽出
					$count2 = 1;
					for( ; $count2<$count1 ; $count2++){
						echo "<tr><td class='screen'><a href='permute/screen.php?screen=$s[$count2]'>" , $s[$count2] , "</a></td>";
						echo "<td class='seat'>" , $x[$count2] , "×" , $y[$count2] , "</td></tr>";
					}
				?>
			</tr>


			<tr>
				<td rowspan="8"><a href="permute/info.php?name=HALシネマ名古屋">HALシネマ名古屋</a></td>
				<?php
					//DBの1行目抽出
					echo "<td class='screen'><a href='permute/screen.php?screen=$s[0]'>" , $s[0] , "</a></td>";
					echo "<td class='seat'>" , $x[0] , "×" , $y[0] , "</td></tr>";

					//DBの2行目以降抽出
					$count2 = 1;
					for( ; $count2<$count1 ; $count2++){
						echo "<tr><td class='screen'><a href='permute/screen.php?screen=$s[$count2]'>" , $s[$count2] , "</a></td>";
						echo "<td class='seat'>" , $x[$count2] , "×" , $y[$count2] , "</td></tr>";
					}
				?>
			</tr>



			<tr>
				<td rowspan="8"><a href="permute/info.php?name=HALシネマ大阪">HALシネマ大阪</a></td>
				<?php
					//DBの1行目抽出
					echo "<td class='screen'><a href='permute/screen.php?screen=$s[0]'>" , $s[0] , "</a></td>";
					echo "<td class='seat'>" , $x[0] , "×" , $y[0] , "</td></tr>";

					//DBの2行目以降抽出
					$count2 = 1;
					for( ; $count2<$count1 ; $count2++){
						echo "<tr><td class='screen'><a href='permute/screen.php?screen=$s[$count2]'>" , $s[$count2] , "</a></td>";
						echo "<td class='seat'>" , $x[$count2] , "×" , $y[$count2] , "</td></tr>";
					}
				?>
			</tr>

		</table>

		<a href="premute/info.php"><img src="../img/tenpo/button1.png" alt="映画館追加" id="button1"></a>
		<a href="premute/screen.php"><img src="../img/tenpo/button2.png" alt="スクリーン追加"></a>

	</article>

	<footer>
		<p><small>Copyright IH12B334	kaito shidara ALLRIGHTS RESERVED.</small>
		</p>
	</footer>
</body>
</html>