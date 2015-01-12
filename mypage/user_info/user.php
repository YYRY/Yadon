<?php
	include ('../../header.php')
?>
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/mypage/user.css" rel="stylesheet" type="text/css">
	<script src="js/script.js"></script>
<?php
if($_GET["customer_id"] == null || !isset($_GET["customer_id"])){
    header("location:../mypage.php?mess=1");
    exit;
}

$customer_cd   = "";
$customer_name = "unknow";
$mail          = "unknow";
$sex           = "unknow";
$seinenn       = "unknow";

if(isset($_GET["customer_id"])){
    $customer_id = $_GET["customer_id"];
}

$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
mysql_select_db("iw32",$con);
mysql_query('SET NAMES utf8', $con );

$user_info = "SELECT customer_id ,customer_name ,mail ,sei ,seinenn FROM customer_m WHERE customer_id = '$customer_id'";
$res = mysql_query($user_info , $con);

?>
	<table class="company">
    		<tbody>
<?php
	if(isset($_SESSION["customer_id"]) ||$_GET["customer_id"]){
			while($row = mysql_fetch_array($res)){
				$customer_name = $row["customer_name"];
				$mail          = $row["mail"];
				$sex           = $row["sei"];
				$seinenn       = $row["seinenn"];
			}
	}
?>
		        <tr>
		            <th class="arrow_box">名前</div></th>
		            <td><?=$customer_name?></td>
		        </tr>
	
        		<tr>
		            <th class="arrow_box">誕生日</th>
		            <td><?=$seinenn?></td>
		        </tr>

		        <tr>
		            <th>性別</th>
		            <td><?=$sex?></td>
		        </tr>

		        <tr>
		            <th>Eメールアドレス</th>
		            <td><?=$mail?></td>
		        </tr>
    		</tbody>
	</table>
	<!-- main table fin -->
	<a href="user_insert.php">情報変更</a>
	<a href="">よく買う人登録</a>
<?php
	include ('../../footer.php');
?>