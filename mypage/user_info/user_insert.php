<?php
	include ('../../header.php');
	$customer_cd = "";
	$customer_cd = 4;//$_SESIION["customer_id"];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
	if (isset($_POST["submit_add"])){
		$new_name = htmlspecialchars($_POST["name"], ENT_QUOTES);
		$new_position_cd = htmlspecialchars($_POST[""], ENT_QUOTES);
		$new_user_cd = htmlspecialchars($_POST["new_user_cd"], ENT_QUOTES);
		$new_user_name = htmlspecialchars($_POST["new_user_name"], ENT_QUOTES);
		$kakunin = htmlspecialchars($_POST["kakunin"], ENT_QUOTES);
		$new_pass = htmlspecialchars($_POST["new_pass"], ENT_QUOTES);
		/******************************
		*****  全角文字を半角に変換  ******
		*******************************/
		$new_shop_cd = mb_convert_kana($new_shop_cd,"as");
		$new_user_cd = mb_convert_kana($new_user_cd,"as");
		$new_user_name = mb_convert_kana($new_user_name,"as");
		$kakunin = mb_convert_kana($kakunin,"as");
		$new_pass = mb_convert_kana($new_pass,"as");
		/******************************
		**********  チェック  ************
		*******************************/
		//番号
		if (!preg_match("/^[0-9]*$/", $new_shop_cd)){
			$error = "店舗コードに誤りがあります。";
		}
		//PWが確認と一緒かどうか
		//if (!preg_match($kakunin, $new_pass)){
		//	$error = "パスワードが確認できません。ご確認用には同じものを記入して下さい。";
		//}
		/******************************
		**********  SQL文作成  ************
		*******************************/
		if ($error==""){
			$sql = "INSERT INTO user VALUES($new_shop_cd,'$new_position_cd','$new_user_cd','$new_user_name','$new_pass')";
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
		<p class="attention"><img src="../../img/mypage/required1.gif" alt="必須" width="26" height="15">マークの項目は入力必須となります。</p>
		<table>
			<tbody>
				<tr>
					<th><label for="name">お名前</label></th>
					<td class="required"><img src="../../img/mypage/required1.gif" alt="必須" width="26" height="15"></td>
					<td><input type="text" name="name" id="name" size="50"><br>
					<span class="supplement">例） HAL　東京</span></td>
				</tr>
				<tr>
					<th><label for="nenrei">誕生日</label></th>
					<td class="required"><img src="../../img/mypage/required1.gif" alt="必須" width="26" height="15"></td>
					<td><input type="text" name="seinenn" id="nenrei" size="8"><br>
					<span class="supplement">例） ハイフンはないしでお願いします。　19921004</span></td>
				</tr>
				<tr>
					<th><label for="seibetu">性別</label></th>
					<td class="required"><img src="../../img/mypage/required1.gif" alt="必須" width="26" height="15"></td>
					<td><select name="seibetu" id="seibetu">
							<option value="">性別の選択</option>
							<option value="男">男</option>
							<option value="女">女</option>
						</select>
					</td>
				</tr>
				<tr>
					<th><label for="email">メールアドレス</label></th>
					<td class="required"></td>
					<td><input type="text" name="email" id="email" size="50"> <span class="supplement">（半角英数字）</span><br>
					<span class="supplement">ご入力間違いのないようにご注意ください</span></td>
				</tr>
			</tbody>
		</table>
		<p class="button"><input type="submit" name="submit_add" value="入力内容の確認画面へ"></p>
	</form>
<?php
	include ('../../footer.php');
?>