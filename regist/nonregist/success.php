<?php

//メールが送られたらTRUE
$flg = false;

/*
//メールアドレスを取得
if( isset( $_POST["mail"] ) ){
	$mail = $_POST["mail"];

	//@があるか検索
	if (strpos($mail, "@") == TRUE) {
		//@がある
		$flg = TRUE;
	}
}
*/

?>

<!DOCTYPE html>
<html>
	<head>
	<title>ログインフォーム</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="yosihiro yanuki" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/success.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="../../js/regist/success.js"></script>

	</head>
<body>
<?php
include ("../../front/header.php");
?>
	<article id="REGIST">
    
    	<h1>ログインフォーム</h1>
        <hr color="#eee">
        <form action="regist_conf.php" method="post">
        	<label><span id="F_title">メールアドレス</span>
            <input type="text" name="mail" id="F_form"></label><br />
                    	<label><span id="F_title">パスワード</span>
            <input type="text" name="mail" id="F_form"></label><br />

            <?php
			//メールを使う場合に使う処理
			//メール送信後のメッセージ（PHPでメール送信）
            if($flg){?>
				<p>
                	入力されたアドレス宛てにメールが送られました。<br />
                	メール内の指示に従ってパスワード登録してください。
				</p>
			<?php }?>

            <input type="image" src="../../img/regist/nonregist/sousin1.png" alt="送信" id="button">
        </form>

    </article>
<?php
include ("../../front/footer.php");
?>
</body>
</html>