<?php

//このページでセッション（メアド）を渡す
//入力ミスでの強制送還でメアドの取得ができない


//ヘッダー読み込み
include "../../header.php";



//エラーメッセージ
$e1 = "";
$e2 = "";
$e3 = "";
$e4 = "";
$e5 = "";
$e6 = "";
$e7 = "";

//エラーフラグ
$flg1 = false;


//メールアドレス
if( isset( $_POST["mail"] ) && $_POST["mail"]!=null ){
	$mail = $_POST["mail"];
}
else{
	header("location:../index.php");
}

//パスワード
if( isset( $_POST["pass"] ) && $_POST["pass"]!=null ){
	$pass = $_POST["pass"];
	$pass_len = strlen($pass);
}
else{
	$e1 = "パスワードを入力して下さい";
	$flg1 = true;
}

//以上の内容で登録しますかのチェック
if( isset( $_POST["check1"] ) && $_POST["check1"]!=null ){
	$check1 = $_POST["check1"];
}
else{
	$e2 = "チェックを入れてください";
	$flg1 = true;
}

//カード番号
if( isset( $_POST["c1"] ) && $_POST["c1"]!=null ){
	$c1 = $_POST["c1"];
}
else{
	$e3 = "カード番号を入力して下さい";
	$flg1 = true;
}

//カード名義人
if( isset( $_POST["c2"] ) && $_POST["c2"]!=null ){
	$c2 = $_POST["c2"];
}
else{
	$e4 = "カード名義人を入力して下さい";
	$flg1 = true;
}

//年
if( isset( $_POST["nenn"] ) && $_POST["nenn"]!=null ){
	$nenn = $_POST["nenn"];
}
else{
	$e5 = "年を設定してください";
	$flg1 = true;
}

//月
if( isset( $_POST["gatu"] ) && $_POST["gatu"]!=null ){
	$gatu = $_POST["gatu"];
}
else{
	$e6 = "月を設定してください";
	$flg1 = true;
}

//セキュリティコード
if( isset( $_POST["c3"] ) && $_POST["c3"]!=null ){
	$c3 = $_POST["c3"];
	$c3_len = strlen($c3);
}
else{
	$e7 = "セキュリティコードを入力して下さい";
	$flg1 = true;
}


//入力内容不備
if($flg1){

	/****************************
	* メールアドレスの暗号化
	****************************/
	//暗号化＆復号化キー
	$key = md5('KQAHGOEUXD');
		
	//暗号化モジュール使用開始
	$td  = mcrypt_module_open('des', '', 'ecb', '');
	$key = substr($key, 0, mcrypt_enc_get_key_size($td));
	$iv  = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		
	//暗号化モジュール初期化
	if (mcrypt_generic_init($td, $key, $iv) < 0) {
	  exit('error.');
	}
		
	//データを暗号化（$A_mailが暗号化されたメールアドレス）
	$A_mail = base64_encode(mcrypt_generic($td, $mail));
		
	//暗号化モジュール使用終了
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);


	header("location:insert.php?err=err&mail=".$A_mail."&e1=".$e1."&e2=".$e2."&e3=".$e3."&e4=".$e4."&e5=".$e5."&e6=".$e6."&e7=".$e7);
	exit;
}



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
            <?php
				echo $mail;
				echo '<input type="hidden" name="mail" value="' . $mail . '">';
			?>
            </div>
            
            <div class="F_box">
            <?php
				for( ; $pass_len>0 ; $pass_len--){
					echo "*";
				}
				echo '<input type="hidden" name="pass" value="' . $pass . '">';
			?>
            </div>
            
            <div class="F_box">ユーザ登録を行う</div>
            
            <div class="F_box">
            <?php
				echo $c1;
				echo '<input type="hidden" name="c1" value="' . $c1 . '">';
			?>
            </div>
            
            <div class="F_box">
            <?php
				echo $c2;
				echo '<input type="hidden" name="c2" value="' . $c2 . '">';
			?>
            </div>
            
            <div class="F_box">
            <?php
				echo $nenn;
				echo "年";
				echo '<input type="hidden" name="nenn" value="' . $nenn . '">';
			?>

            <?php
				echo $gatu;
				echo "月";
				echo '<input type="hidden" name="gatu" value="' . $gatu . '">';
			?>
            </div>
            
            <div class="F_box">
            <?php
				for( ; $c3_len>0 ; $c3_len--){
					echo "*";
				}
				echo '<input type="hidden" name="c3" value="' . $c3 . '">';
			?>
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