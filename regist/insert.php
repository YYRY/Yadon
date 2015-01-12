<?php

//ヘッダー読み込み
include "../header.php";


$e_flg1 = false;
//エラーがあるかチェック
if( isset($_GET["err"]) ){
	$e_flg1 = true;
}

//名前エラー
if( isset($_GET["e1"]) ){
	$e1 = $_GET["e1"];
}else{
	$e1 = "";
}
//パスワードエラー
if( isset($_GET["e2"]) ){
	$e2 = $_GET["e2"];
}else{
	$e2 = "";
}
//カード番号エラー
if( isset($_GET["e3"]) ){
	$e3 = $_GET["e3"];
}else{
	$e3 = "";
}
//カード名義人エラー
if( isset($_GET["e4"]) ){
	$e4 = $_GET["e4"];
}else{
	$e4 = "";
}
//年エラー
if( isset($_GET["e5"]) ){
	$e5 = $_GET["e5"];
}else{
	$e5 = "";
}
//月エラー
if( isset($_GET["e6"]) ){
	$e6 = $_GET["e6"];
}else{
	$e6 = "";
}
//セキュリティコードエラー
if( isset($_GET["e7"]) ){
	$e7 = $_GET["e7"];
}else{
	$e7 = "";
}



//メールアドレス取得
if( isset($_GET["mail"]) ){
	$mm = $_GET["mail"];
}else if($e_flg1 == false){
	header( "location:regist.php" );
	exit;
}



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

//データを復号化
$F_mail = mdecrypt_generic($td, base64_decode($mm));

//暗号化モジュール使用終了
mcrypt_generic_deinit($td);
mcrypt_module_close($td);


//入力されたメールアドレス（複合の時に変な文字コードが付与されるのでトリミング）
$F_mail2 = trim($F_mail, "\x00..\x1F");



//セッションを渡す
session_start();
$_SESSION["mail"] = $F_mail2;

//セッションのphp読み込み
//include "../include_session/session.php";


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
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/reserved/insert.css" rel="stylesheet" type="text/css">

	<!--  js  -->

	</head>
<body>

<article>

<div id="Forms">

    <div id="Form_left">
        <div class="F_box">メールアドレス</div>
        <div class="F_box">名前</div>
        <div class="F_box">パスワード</div>
        
        <div class="F_box">カード番号</div>
        <div class="F_box">カード名義人</div>
        <div class="F_box">カード有効期限</div>
        <div class="F_box">セキュリティコード</div>
    </div>
    
    
    
    <div id="Form_right">
        <form action="insert_check.php" method="POST">
            <div class="F_box">
            <?php
				echo $F_mail2;
				echo '<input type="hidden" name="mail" value="'.$F_mail2.'">';
			?>
            </div>
            <div class="F_box">
				<?php
				if($e1 != ""){
					echo "<span class='red'>".$e1."</span><br />";
				}?>
	            <input type="text" name="name" class="text">
            </div>
            <div class="F_box">
				<?php
				if($e2 != ""){
					echo "<span class='red'>".$e2."</span><br />";
				}?>
	            <input type="password" name="pass">
            </div>
            
            <div class="F_box">
       			<?php
				if($e3 != ""){
					echo "<span class='red'>".$e3."</span><br />";
				}?>
            	<input type="text" name="c1" class="text">
            </div>
            <div class="F_box">
            	<?php
				if($e7 != ""){
					echo "<span class='red'>".$e7."</span><br />";
				}?>
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
            	<?php
				if($e1 != ""){
					echo "<span class='red'>".$e1."</span><br />";
				}?>
                <input type="password" name="c3" class="text">
            </div>
        </div>
    
        <div class="clear"></div>
    
        <input type="submit" value="確認">
    </form>

</div>

</article>

<?php
include '../footer.php';
?>


</body>
</html>