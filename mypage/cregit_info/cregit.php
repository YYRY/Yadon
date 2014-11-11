<?php
	session_start();
	$CustmerId = $_SESSION["CustmerId"];

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);

	//sql文作成
	$sql = "SELECT card_n ,card_h ,card_d from credit_m where credit_id LIKE ".$CustmerId."";

	//sql実行
	$res = mysql_query($sql , $con);

	//DB切断
	mysql_close($con);

?>

<?php
include '../../header.php';
?>
	<article>
		<section>
			<div>
				<table>
					<tr>
						<th>カード番号</th>
						<th>名義人名</th>
						<th>有効期限</th>
					</tr>
					<tr>
<?php
		
		 while($row = mysql_fetch_array($res)){
			echo "<td>".$row["card_n"]."</td>";
			echo "<td>".$row["card_h"]."</td>";
			echo "<td>".$row["card_d"]."</td>";
			echo "</tr>";
			}


	$mess = "";
		if(isset($_GET["message"])){
			$messflog = $_GET["message"];
			if($messflog == 1){
				$mess="２枚以上のカードを登録できません。";
			}else if($messflog == 3){
				$mess="カード番号を入力して下さい。";
			}else if($messflog == 4){
				$mess="カードのご名義人様を入力して下さい。";
			}else if($messflog == 11){
				$mess="カード番号に数字以外が記入されました。";
			}
		}
?>
				</table>
				<div id="messArea"><span style="color:red"><?=$mess?></span></div>
				<form action="insert.php" method="POST">
					<table>
						<tr>
							<td>カード番号</td>
							<td><input type="text" name="card_no"></td>
						</tr>
						<tr>
							<td>カード名義人</td>
							<td><input type="text" name="card_name"></td>
						</tr>
						<tr>
							<td>カード有効期限</td>
							<td><select name="tuki">
									<option value="1">1
									<option value="2">2
									<option value="3">3
									<option value="4">4
									<option value="5">5
									<option value="6">6
									<option value="7">7
									<option value="8">8
									<option value="9">9
									<option value="10">10
									<option value="11">11
									<option value="12">12
								</select>月
								<select name="nen">
									<option value="2014">2014
									<option value="2015">2015
									<option value="2016">2016
									<option value="2017">2017
									<option value="2018">2018
									<option value="2019">2019
									<option value="2020">2020
								</select>年
							</td>
						</tr>
						<tr>
							<td>セキュリティーコード</td>
							<td><input type="text" name="code"></td>
						</tr>
					</table>
					<input type="submit" value="追加">
				</form>
			</div>
			<a href="../mypage.php">マイページに戻る</a><br>
		</section>
	</article>
<?php
include '../../footer.php';
?>