<?php

//ヘッダー読み込み
include "../../header.php";

?>

<!DOCTYPE html>
<html>
	<head>
	<title>非会員 映画予約会員登録</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/nonregist/regist.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="../../js/regist/nonregist/regist.js"></script>

	</head>
<body>

	<article id="REGIST">
    
    	<h1>仮会員登録</h1>
        <hr color="#eee">
        <form action="insert.php" method="post">

			<p class="red">PHPでエラーメッセージが出る</p>

        	<label><span class="F_title">メールアドレス</span>
            <input type="text" name="mail" class="F_form"></label>
            
            <input type="image" src="../../img/regist/nonregist/kakuninn1.png" alt="送信" id="button">
        </form>

    </article>

	<?php
    include '../../footer.php';
    ?>

</body>
</html>