<?php

//ヘッダー読み込み
include "../../header.php";


//テスト表示用（運用時には if・else 削除）
if( isset( $_GET["error"] ) ){
	//エラーメッセージ（又はエラー番号）を取得
	$error = $_GET["error"];
}
else{
	$error = "エラー文表示";
}

?>
<!DOCTYPE html>
<html>
	<head>
	<title>予約エラー</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/nonregist/regist_error.css" rel="stylesheet" type="text/css">

	</head>
<body>


	<article id="REGIST">
    	<p>
        	<span class="red"><?= $error ?></span><br />
        	メールアドレスを再登録してください。<br /><br />
            <a href="regist.php">再登録する</a>
        </p>
    </article>


	<footer>
		<p><small>Copyright IH12B334	kaito shidara ALLRIGHTS RESERVED.</small>
		</p>
	</footer>
</body>
</html>