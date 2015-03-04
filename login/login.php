<?php

$flg1 = false;
$flg2 = false;
$link_saki = 0;
$e_flg1 = false;
$mail="";
$pass="";

if( isset($_POST["mail"]) ){
	$mail = $_POST["mail"];
	$flg1 = true;
}
if( isset($_POST["pass"]) ){
	$pass = $_POST["pass"];
	$flg1 = true;
}

//特殊リンク用
if( isset($_GET["link1"]) ){
	$flg2 = true;
}
//movie/detail.php用
if( isset($_POST["links"]) ){
	$link = $_POST["links"];
	if($link == "detail"){
		$link_saki = 1;
		$flg1 = true;
	}
}


//入力があった場合
if($flg1){
	/*****************
	* DB接続設定
	*****************/
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_query("SET NAMES utf8");
	mysql_select_db("iw32",$con);
	
	$sql="
	select customer_id , pass , mail
	from customer_m
	where mail = '$mail' and pass = '$pass'
	";
	
	$res = mysql_query($sql,$con);
	mysql_close($con);
	while($row = mysql_fetch_array($res)){
		
		$customer_id = $row[0];
		//セッションスタート
		session_start();
		$_SESSION["c_id"] = $customer_id;

		//movie/detail.phpへリンク
		if($link_saki == 1){
			header( "location:../movie/detail.php" );
			exit;
		}else{
			header( "location:../index.php" );
			exit;
		}
	}

	$e_flg1 = true;

}

//ヘッダー読み込み
include "../header.php";
?>
<!DOCTYPE html>
<html>
	<head>
	<title>ログイン</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->

	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/login/login.css" rel="stylesheet" type="text/css">

	<!--  js  -->

	</head>
<body>


<article>

	<h1>ログイン</h1>
	<hr color="#eee">
	<form action="login.php" method="post">
	<?php if($flg2){ ?>
		<input type="hidden" name="links" value="detail">
	<?php } ?>

		<p class="red">
		<?php
        if($e_flg1){
			echo "入力内要が誤っています";
		}
		?></p>
		<table border="0" class="login-table">
		<tr>
			<th>
				<label><span class="F_title">メールアドレス</span>
			</th>
			<td>
				<input type="text" name="mail" class="F_form"></label>
			</td>
		</tr>
		<tr>
			<th>
				<label><span class="F_title">パスワード</span>
			</th>
			<td>
				<input type="password" name="pass" class="F_form"></label>
			</td>
		</tr>
		<tr>
			<td>
			<input type="image" src="../img/regist/nonregist/kakuninn1.png" alt="送信" id="button">
		</td>
		</tr>
	</table>
    </form>

</article>

<?php
include '../footer.php';
?>


</body>
</html>