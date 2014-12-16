<?php
	include ('../../header.php');
	$customer_cd = "";
	$customer_cd = 4;//$_SESIION["customer_id"];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST["submit_add"])){
		$new_name        = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$new_position_cd = htmlspecialchars($_POST[""], ENT_QUOTES);
		$new_user_cd     = htmlspecialchars($_POST["new_user_cd"], ENT_QUOTES);
		$new_user_name   = htmlspecialchars($_POST["new_user_name"], ENT_QUOTES);
		$kakunin         = htmlspecialchars($_POST["kakunin"], ENT_QUOTES);
		$new_pass = htmlspecialchars($_POST["new_pass"], ENT_QUOTES);

		$new_shop_cd = mb_convert_kana($new_shop_cd,"as");
		$new_user_cd = mb_convert_kana($new_user_cd,"as");
		$new_user_name = mb_convert_kana($new_user_name,"as");
		$kakunin = mb_convert_kana($kakunin,"as");
		$new_pass = mb_convert_kana($new_pass,"as");

		//番号
		if (!preg_match("/^[0-9]*$/", $new_shop_cd)){
			$error = "店舗コードに誤りがあります。";
		}

		if ($error==""){
			$sql = "INSERT INTO customer_m VALUES($new_shop_cd,'$new_position_cd','$new_user_cd','$new_user_name','$new_pass') WHERE customer_id = '$customer_id'";
		}
	}

	if ($error==""){
		$mysql->query($sql);
		$new_shop_cd = "";
		$new_position_cd = "";
		$new_user_cd = "";
		$new_user_name = "";
		$kakunin = "";
		$new_pass = "";
	}
}





?>
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/mypage/user.css" rel="stylesheet" type="text/css">

	<script src="js/script.js"></script>

	<a href="user.html">ユーザ情報</a>&nbsp;>&nbsp;ユーザ情報変更	
	<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST" class="contact">
		<p>以下のフォームにご入力の上、「入力内容の送信」ボタンをクリックしてください。</p>
		<table>
			<tbody>
				<tr>
					<th><label for="name">お名前</label></th>
					<td><input type="text" name="name" id="name" size="30"><br>
					<span class="supplement">例） HAL　東京</span></td>
				</tr>
				<tr>
					<th><label for="pass">パスワード</label></th>
					<td><input type="text" name="pass" id="pass"></td>
				</tr>
				<tr>
					<th><label for="pass">パスワード(確認用)</label></th>
					<td><input type="text" name="seinenn" id="nenrei"></td>
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