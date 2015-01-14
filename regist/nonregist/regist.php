<?php
/*このページ（nonregist）は…
「映画見たい」
　↓
映画座席予約する
　↓
「会員登録めんどい」
　↓
メアドだけ今すぐ登録
（後で名前とかも細かく設定）
*/



//エラーフラグとメッセージ
$E_flg = false;
$mes = "";

//送信情報取得
if( isset( $_POST["mail"] ) ){
	$mail = $_POST["mail"];

	//-----メールアドレス-----
	//何も入力が無かった
	if($mail == null){
		$mes = "メールアドレスを入力してください<br /><br />";
		$Eflg = true;
	}
	//全角半角チェック
	else if(strlen($mail) != mb_strlen($mail)){
		$mes = "メールアドレスは半角で入力してください<br /><br />";
		$Eflg = true;
	}
	//@マークがあるかチェック
	else if(!strstr($mail, '@')){
		$mes = "@マーク以下も入力してください<br /><br />";
		$Eflg = true;
	}
	//問題なくメールアドレスが入力された
	else{

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


		/***************************
		* メールの送信
		***************************/
		//文字コード設定
		mb_language("Japanese");
		mb_internal_encoding("UTF-8");
		
		//*環境設定*************************************
		//件名
		$subject = "HALシネマ 会員登録";
		//管理人メールアドレス(宛先)
		$to = $mail;
		//**********************************************

		//**POSTデータ受け取り**************************
		//差出人メールアドレス格納
		$header = "From: fujita1@localhost";
		
		//本文格納
		$body = "
		HALシネマの会員登録用メールです。\n
		会員情報登録に進むため、リンク先をクリックしてパスワード等の設定をして下さい：<http://localhost/iw32/front/regist/nonregist/insert.php?mail=".$A_mail.">
		";// <>で囲むとリンクと認識される

		//メール送信
		if(mb_send_mail($to,$subject,$body,$header)){
		$mes = 
		  "「".$mail."」宛にメールを送信しました<br />
		  メール内から会員情報詳細設定ページへ移動できます。<br /><br />
		";
		}else{
			$mes = "メール送信に失敗しました<br /><br />";
		}

	}

}else{
	$mail = "no";
}


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
        <form action="regist.php" method="post">

			<p class="red"><?= $mes ?></p>

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