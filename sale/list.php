<?php
include('../header.php');

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_query('SET NAMES utf8', $con );
	mysql_select_db("iw32",$con);
	$sql = "SELECT service_name ,service_detail FROM discount_m";

	$res = mysql_query($sql , $con);
	mysql_close($con);
?>
	<a href="#">TOP</a>>割引一覧
	<div id="main">
		<div id="leftcolumn">
<?php
while($row = mysql_fetch_array($res)){
				echo"<div>".$row['service_name']."</div>";
				echo "<div>".$row['service_detail']."</div>";
		}
?>
		</div><!-- leftcolumn fin -->
	</div><!-- main fin -->
<?php
include('../footer.php');
?>