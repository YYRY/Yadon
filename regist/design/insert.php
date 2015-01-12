<?php

//ヘッダー読み込み
include "../../header.php";

?>

<!DOCTYPE html>
<html>
	<head>
	<title>会員情報入力</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
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
        <form action="insert_check.php" method="POST">
            <div class="F_box">
            入力されたメールアドレス
            </div>
            <div class="F_box">
		<input type="password" name="pass" class="text">
            </div>
            <div class="F_box">
		<input type="checkbox" name="check1" value="1">
            </div>
            
            <div class="F_box">
       		<input type="text" name="c1" class="text">
            </div>
            <div class="F_box">
            	<input type="text" name="c2" class="text">
            </div>
            <div class="F_box">
                <select name="nenn">
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                </select>年
                
                <select name="gatu">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>月
            </div>
            <div class="F_box">
                <input type="password" name="c3" class="text">
            </div>
        </div>
    
        <div class="clear"></div>
    
        <input type="submit" value="確認">
    </form>

</div>

</article>

<?php
include '../../footer.php';
?>


</body>
</html>