<?php
include('../header.php');

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	$sql = "SELECT title ,description ,s.movie_id ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id ORDER BY movie_start DESC";

	$res = mysql_query($sql , $con);


$year1 = date("Y");				//年をセット
$month1 = date("m");			//月をセット
$day1 = date("d");
$day2 = date("d")+1;
$day3 = date("d")+2;
$ymd = date("Ymd");

//DBに登録されないバグ消し
if($month1 < 10){
	$month1 = substr($month1, 1, 1); 
}


?>

	<link href="../css/index.css" rel="stylesheet" type="text/css">
	<link href="../css/movie/movie.css" rel="stylesheet" type="text/css">
	<div id="main">
		<div id="leftcolumn">
<?php

			while($row = mysql_fetch_array($res)){

				$mov = $row["movie_id"];

				if( $row["3d"] ==0){
					$real = "なし";
				}else{
					$real = "あり";
				}
				echo "<div class=\"box1\">";
					echo "<table>";
						echo "<tr>";
						echo "<td style=\"width:5px; height: 30px; background-color:#0000ff;\"></td>";
						echo "<td><strong>".$row["title"]."</strong></td>";
						echo "</tr>";
					echo "</table>";
					echo"<div class=\"box1_img\">";
						echo "<img src='../img/moviePhoto/".$row['movie_id'].".jpg'\" width=\"200px\" height=\"auto\">";
					echo "</div>";
					echo "<div class=\"box1_text\">";
						echo $row["description"];
					echo "</div>";
					echo "<div class=\"clear\"></div>";
					echo "<div class=\"box2_text\">";
						echo "<div class=\"movieStart\">".$row["movie_start"]."～</div>";
						echo "3D上映".$real;
					echo "</div>";
					echo "<p id='yoyakusuru'>予約する</p>";
					echo "<a class='btn' href='detail.php?day=".$month1.$day1."&time=1530&mov=".$mov."'>".$year1."年".$month1."月".$day1."日<br />15:30～18:00</a>";
					echo "<a class='btn' href='detail.php?day=".$month1.$day1."&time=930&mov=".$mov."'>".$year1."年".$month1."月".$day1."日<br />9:30～12:30</a><br /><br /><br />";
					echo "<a class='btn' href='detail.php?day=".$month1.$day2."&time=1530&mov=".$mov."'>".$year1."年".$month1."月".$day2."日<br />15:30～18:00</a>";
					echo "<a class='btn' href='detail.php?day=".$month1.$day2."&time=930&mov=".$mov."'>".$year1."年".$month1."月".$day2."日<br />9:30～12:30</a><br /><br /><br />";
					echo "<a class='btn' href='detail.php?day=".$month1.$day3."&time=1530&mov=".$mov."'>".$year1."年".$month1."月".$day3."日<br />15:30～18:00</a>";
					echo "<a class='btn' href='detail.php?day=".$month1.$day3."&time=930&mov=".$mov."'>".$year1."年".$month1."月".$day3."日<br />9:30～12:30</a>";
//					echo "<a class='btn' href='detail.php?mov=".$mov."'>作品詳細</a>";
//					echo "<a class=\"btn\" href=\"detail.php?movie=\">作品詳細</a>";
					echo "<div class=\"clear\"></div>";
					echo "<hr size=\"3\" color=\"black\" width=\"100%\">";
					
					
				echo "</div>";
			}
?>
		</div><!-- leftcolumn fin-->
		<div id="rightcolumn">
			<div class="right_waku">
			<div class="right_h3">お知らせ</div>
			<div class="new">
				<ul>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				</ul>
			</div>
			</div>

			<div class="right_waku">
			<div class="right_h3">お知らせ</div>
			<div class="new">
				<ul>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				<li>00/00：更新しました</li>
				</ul>
			</div>
			</div>
							
			</div>
			<img src="../img/movie/koukousei_r.jpg" width="295px">
			<img src="../img/movie/koukousei_r.jpg" width="295px">
			<img src="../img/movie/koukousei_r.jpg" width="295px">
			<img src="../img/movie/koukousei_r.jpg" width="295px">
			</div>
		
		</div><!-- rightcolumn fin-->
		<div class="clear"></div>
	</div><!-- main fin -->
<?php
include('../footer.php');
?>