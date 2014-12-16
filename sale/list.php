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
<head>
	<link href="../../css/list.css" rel="stylesheet" type="text/css">
</head>
	<a href="#">TOP</a><span>>割引一覧</span>
	<div id="main">
		<div id="leftcolumn">
<?php
while($row = mysql_fetch_array($res)){
				echo"<div class='line'>".$row['service_name']."</div>";
				echo "<div class='line'>".$row['service_detail']."</div>";
		}
?>
		</div><!-- leftcolumn fin -->
	</div><!-- main fin -->
<?php
include('../footer.php');
?>