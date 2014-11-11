<?php

//テスト表示用（運用時には if・else 削除）
if( isset( $_GET["error"] ) ){
	//エラーメッセージ（又はエラー番号）を取得
	$error = $_GET["erroe"];
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
	<meta name="author" content="yosihiro yanuki" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/regist_error.css" rel="stylesheet" type="text/css">

	</head>
<body>
<?php
include ("../../front/header.php");
?>

	<article id="REGIST">
    	<p>
        	<span class="red"><?= $error ?></span><br />
        	メールアドレスが違います。<br /><br />
            <a href="regist.php">再登録する</a>
        </p>
    </article>

<?php
include ("../../front/footer.php");
?>
</body>
</html>