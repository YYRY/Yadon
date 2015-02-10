<?php
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );

	/*******************************
	*********   update   **************
	********************************/
	if(isset($_POST["submit_upd"])){
		$no = key($_POST["submit_upd"]);

		$customer_id   = htmlspecialchars($_POST["customer_id"][$no],ENT_QUOTES);
		$customer_name = htmlspecialchars($_POST["customer_name"][$no],ENT_QUOTES);
		$mail          = htmlspecialchars($_POST["mail"][$no],ENT_QUOTES);
		$sei           = htmlspecialchars($_POST["sei"][$no],ENT_QUOTES);
		$seinenn       = htmlspecialchars($_POST["seinenn"][$no],ENT_QUOTES);
		$sql = "UPDATE customer_m SET customer_id='$customer_id' ,customer_name='$customer_name' ,mail='$mail' ,sei='$sei' ,seinenn='$seinenn' WHERE customer_id=$no";
		$res = mysql_query($sql,$con);
	}
?>
<style>
.cus-section{
	width:960px;
	margin:0 auto;
	padding: 20px 10px;
}
.cus-section table{
	font-size: 12px;
    margin: 0 auto;
    border-collapse: separate;
    border-spacing: 0px 1px;
}
.cus-section td{
	padding: 12px;
    vertical-align: middle;
    text-align: left;
    border-bottom: #999 1px solid;
    font-size: 11px;
}
.cus-section table span{
	color: #ee2222;
}
.cus-section table span:hover{
	text-shadow:1px 1px 1px;
}
.cus-section table .del{
	cursor: pointer;
}
</style>
	<section class="cus-section">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
		<table>
			<tr>
				<th>会員番号</th>
				<th>名前</th>
				<th>メールアドレス</th>
				<th>性別</th>
				<th>誕生日</th>
				<th>変更</th>
				<th>削除</th>
			</tr>
<?php
	$sql = "SELECT * FROM customer_m";

	$res = mysql_query($sql , $con);
	$customer_num = mysql_num_rows($res);

	if($customer_num > 0){
		while($row = mysql_fetch_array($res)){
			$customer_id   = $row["customer_id"];
			$customer_name = $row["customer_name"];
			$mail          = $row["mail"];
			$sei           = $row["sei"];
			$seinenn       = $row["seinenn"];
			$sex           = "color:#000;";
			if($sei == "男"){
				$sex = "color:blue;";
			}else if($sei == "女"){
				$sex = "color:red;";
			}
$string = <<< EOM
<td><input type="hidden" name="customer_id[$customer_id]" value="$customer_id">$customer_id</td>
<td><input type="test"   name="customer_name[$customer_id]" value="$customer_name"></td>
<td><input type="text"   name="mail[$customer_id]" value="$mail"></td>
<td><input type="text"   name="sei[$customer_id]" value="$sei" style="$sex"></td>
<td><input type="text"   name="seinenn[$customer_id]" value="$seinenn"></td>
<td><input type="submit" name="submit_upd[$customer_id]" value="変更" class='upd'></td>
<td><span onclick='del(${customer_id})' title='ユーザーを削除する。' class='del'>X</span></td>
</tr>
EOM;
	echo $string;
		}
	}else{
		echo "<td>顧客情報がありません。</td></tr>";
	}		
?>
		</table>
		</form>
	</section>
<script type="text/javascript">
function del(n){
	if(confirm("削除しますか？")){
		location.href = "php/cus-deleate.php?customer_id="+n;
	}
}
</script>
<?php
// include('../footer.php');
?>