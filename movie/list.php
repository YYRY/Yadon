<?php
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	$sql = "SELECT title ,description ,s.movie_id ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id ORDER BY movie_start DESC";

	$res = mysql_query($sql , $con);


?>
<?php
include('../header.php');
include "../include_session/session.php";
?>
	<div id="main">
<?php

			while($row = mysql_fetch_array($res)){
				if( $row["3d"] ==0){
					$real = "なし";
				}else{
					$real = "あり";
				}
				echo "<div class=\"box1\">";
					echo"<div class=\"box1_img\">";
						echo "<img src='../img/moviePhoto/".$row['movie_id'].".jpg'\" width=\"150px\" height=\"100px\">";
					echo "</div>";
					echo "<div class=\"box1_text\">";
						echo $row["title"];
					echo "</div>";
					echo "<div class=\"box1_text\">";
						echo $row["description"];
					echo "</div>";
					echo "<div class=\"clear\"></div>";
					echo "<div class=\"box2_text\">";
						 echo "<div class=\"movieStart\">".$row["movie_start"]."～</div>";
						 echo "3D上映".$real;
					echo "</div>";
				echo "</div>";
			}
?>
		</div><!-- leftcolumn fin-->
	</div><!-- main fin -->
<?php
include('../footer.php');
?>