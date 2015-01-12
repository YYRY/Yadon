<?php
	include ('../../header.php');
	$customer_id = 4;//$_SESIION["customer_id"];
	$error       = "";
	$scucess     = "";

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST["submit_add"])){
		$new_name    = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$new_pass    = htmlspecialchars($_POST["pass"], ENT_QUOTES);
		$new_kakunin = htmlspecialchars($_POST["kakunin"], ENT_QUOTES);
		$new_email   = htmlspecialchars($_POST["email"], ENT_QUOTES);

		if($new_pass != $new_kakunin){
			$error = "確認用パスワードとパスワードが異なります。";
		}
		if($new_email !=""){
			if (!preg_match("/@/i", $new_email)){
			    $error = "メールアドレスが正しくありません。";
			}
		}
		$sql = "UPDATE customer_m SET customer_name = '$new_name' ,pass = '$new_pass' ,mail = '$new_email' WHERE customer_id = '$customer_id';";
	}

	if ($error==""){
		$res = mysql_query($sql , $con);
		$scucess     ="更新完了しました。";
		$new_name    = "";
		$new_pass    = "";
		$new_kakunin ="";
		$new_email   = "";
	}
}





?>
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/mypage/user.css" rel="stylesheet" type="text/css">

	<script src="js/script.js"></script>

	<a href="user.html">ユーザ情報</a>&nbsp;>&nbsp;ユーザ情報変更	
	<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" class="contact">
		<p>以下のフォームにご入力の上、「入力内容の送信」ボタンをクリックしてください。</p>
		<?php echo $error; echo $scucess;?>
		<table>
			<tbody>
				<tr>
					<th><label for="name">お名前</label></th>
					<td><input type="text" name="name" id="name" size="30"><br>
					<span class="supplement">例） HAL　東京</span></td>
				</tr>
				<tr>
					<th><label for="pass">パスワード</label></th>
					<td><input type="password" name="pass" id="pass"></td>
				</tr>
				<tr>
					<th><label for="kakunin">パスワード(確認用)</label></th>
					<td><input type="password" name="kakunin" id="kakunin"></td>
				</tr>
				<tr>
					<th><label for="email">メールアドレス</label></th>
					<td><input type="text" name="email" id="email" size="60"> <span class="supplement">（半角英数字）</span><br>
					<span class="supplement">ご入力間違いのないようにご注意ください</span></td>
				</tr>
			</tbody>
		</table>
		<p class="button"><input type="submit" name="submit_add" value="入力内容の確認画面へ"></p>
	</form>
<?php
	include ('../../footer.php');
?>