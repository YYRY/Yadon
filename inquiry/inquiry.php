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
<body>
	<a href="<?=$root ?>/index.php">TOP</a>>お問い合わせ
	<div id="main">
		<div id="leftcolumn">
			<div id="inquiry">
				<div class="inquirytext">
					<img src="<?=$root ?>/img/logo.png" class="imgbox">
					<h1>お問い合わせ</h1>
					<h2>HAL CINEMAS</h2>
					<h4>開店時間</h4>
					<p>平日・祝日・日曜(9:00~12:00)まで<br />
					電話番号 03-0000-0000<br />
					</p>
				</div>
			</div><!-- inquiry -->
<!--<?php
while($row = mysql_fetch_array($res)){
				echo"<div>".$row['service_name']."</div>";
				echo "<div>".$row['service_detail']."</div>";
		}
?>-->
		</div><!-- leftcolumn fin -->
	</div><!-- main fin -->
<body>
<?php
include('../footer.php');
?>