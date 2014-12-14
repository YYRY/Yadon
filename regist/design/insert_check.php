<?php

//ヘッダー読み込み
include "../../header.php";

?>

<!DOCTYPE html>
<html>
	<head>
	<title>会員情報確認</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/reserved/insert.css" rel="stylesheet" type="text/css">

	<!--  js  -->

	</head>
<body>

<article>

<div id="Forms">

    <div id="Form_left">
        <div class="F_box">メールアドレス</div>
        <div class="F_box">パスワード</div>
        <div class="F_box">上記内要でユーザー登録を行う</div>

        <div class="F_box">カード番号</div>
        <div class="F_box">カード名義人</div>
        <div class="F_box">カード有効期限</div>
        <div class="F_box">セキュリティコード</div>
    </div>
    
    
    
    <div id="Form_right">
        <form action="success.php" method="POST">
            <div class="F_box">
				入力されたメールアドレス
            </div>
            
            <div class="F_box">
            	入力されたパスワード
            </div>
            
            <div class="F_box">ユーザ登録を行う</div>
            
            <div class="F_box">
            入力されたカード番号
            </div>
            
            <div class="F_box">
            入力されたカード名義人
            </div>
            
            <div class="F_box">
            2014年11月
            </div>
            
            <div class="F_box">
            入力されたセキュリティコード
            </div>
            
        </div>
    
        <div class="clear"></div>
        
        <input type="submit" value="登録">

    </form>

</div>

</article>

<?php
include '../../footer.php';
?>


</body>
</html>