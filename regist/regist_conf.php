<?php

//テスト表示用（運用時には if文削除）
if( isset( $_POST["mail"] ) ){
	//メールアドレス取得
	$mail = $_POST["mail"];
}

?>

<!DOCTYPE html>
<html>
	<head>
	<title>会員 映画予約フォーム2</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="yosihiro yanuki" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/regist_conf.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="../../js/regist/regist_conf.js"></script>

	</head>
<body>
<?php
include ("../../front/header.php");
?>

	<article id="REGIST">
    
    	<h1>映画予約：パスワード入力</h1>
        <hr color="#eee">
        <p>6～12文字以内で入力してください</p>
        <form action="success.php" method="post">
        	<input type="hidden" name="mail" value="<?= $mail ?>">
        	<label><span class="F_title">パスワード</span>
            <input type="password" maxlength="12" name="pass1" onblur="check1()" class="F_form" id="f1"></label>

            <p>
            	確認のためもう一度入力してください。
            	<span id="error"><br />パスワードが違います！</span>
            </p>

        	<label><span class="F_title"></span>
            <input type="password" maxlength="12" name="pass2" onblur="check2()" class="F_form" id="f2"></label>

            <input type="image" src="../../img/regist/touroku1.png" alt="送信" id="button">
        </form>

    </article>
<?php
include ("../../front/footer.php");
?>
</body>
</html>