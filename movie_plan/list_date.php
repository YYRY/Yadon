<?php
include('../header.php');


	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	date_default_timezone_set('UTC');

	$next_month = date('Y-m', mktime(0, 0, 0, date('n') + 1, 1, date('Y')));
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	$sql = "SELECT m.title, m.description ,s.movie_id ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id WHERE s.movie_start LIKE '$next_month%'";

	$res = mysql_query($sql , $con);
	mysql_close($con);
	
?>
	<div id="main">
		<div id="leftcolumn">
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
			$hakoDay = array('日曜めっちゃお得デイ♪','menzu','シニア割','ハードゲイ','レディースデイ','華の金曜！','うんこ');
			$hakoMoney = array(3300,2500,300,500,400,300,300); 
			$day = date('w');
?>
		</div>
	<!-- leftcolumn fin-->

		<div id="rightcolumn">
			<table class="company">
    				<tbody>
						<tr>
				        	<th class="arrow_box">今日のサービス</div></th>
				        </tr>
				        <tr>
				            <th class="arrow_box"><?php echo $hakoDay[$day];?></th>
				            <td><?php echo "チケットから".$hakoMoney[$day]."円引きです。";?></td>
				        </tr>
    				</tbody>
			</table>
		</div><!-- rightcolumn fin-->
		<div class="clear"></div>

	</div><!-- main fin -->
<?php
include('../footer.php');
?>