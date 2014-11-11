<?php

//ヘッダー読み込み
include "../../header.php";


//送信情報取得
$mail = $_POST["mail"];
$pass1 = $_POST["pass1"];
$pass2 = $_POST["pass2"];


//エラーフラグ
$Eflg = false;

//エラーメッセージ用
$m_er = "";
$p_er = "";

//-----メールアドレス-----
//何も入力が無かった
if($mail == null){
	$m_er = 1;
	$Eflg = true;
}
//全角半角チェック
else if(strlen($mail) != mb_strlen($mail)){
	$m_er = 2;
	$Eflg = true;
}
//@マークがあるかチェック
else if(!strstr($mail, '@')){
	$m_er = 3;
	$Eflg = true;
}

//-----パスワード-----
//パスが両方同じものが入力されているかチェック
if($pass1!=null && $pass2!=null){
	if($pass1 != $pass2){
		$p_er = 1;
		$Eflg = true;
	}
}
//入力無しだった
else{
	$p_er = 2;
	$Eflg = true;
}

//エラーがあった
if($Eflg){
	header("Location:regist.php?error1_1=".$m_er."&error1_2=".$p_er);
	exit;
}

//パスの文字数カウント
$count = mb_strlen($pass1);

?>

<!DOCTYPE html>
<html>
	<head>
	<title>非会員 登録内容確認</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../../css/common.css" rel="stylesheet" type="text/css">
	<link href="../../css/regist/nonregist/regist_conf.css" rel="stylesheet" type="text/css">

	<!--  js  -->
	<script src="../../js/regist/nonregist/regist_conf.js"></script>

	</head>
<body>

	<article id="REGIST">
		<h1>仮会員確認</h1>
        <hr color="red">
        <div class="block">
            <div class="left">メールアドレス</div>
            <div class="right"><? echo $mail; ?></div>
        </div>
        
        <div class="block">
	        <div class="left">パスワード</div>
	        <div class="right">
			<?php
				for( ; $count>0 ; $count--){
	            	echo "*";
				}
			?>
            </div>
        </div>
        
        <p>上記の内容で会員登録して、座席予約に進みます。</p>
        <form action="success.php" method="post">
        	<input type="hidden" name="mail" value="<? $mail ?>">
        	<input type="hidden" name="pass" value="<? $pass1 ?>">
            <input type="image" src="../../img/regist/nonregist/touroku1.png" alt="登録" id="button">
		</form>
    </article>

	<footer>
		<p><small>Copyright IH12B334	kaito shidara ALLRIGHTS RESERVED.</small>
		</p>
	</footer>
</body>
</html>