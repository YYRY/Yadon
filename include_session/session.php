<?php
//セッションフラグ
$s_flg = false;

//セッションスタート
session_start();

//セッションが無い状態
if( !isset( $_SESSION["s_mail"] ) || $_SESSION["s_mail"] == null ){

}
//セッションがあった
else{
	//セッションにデータを格納
	$_SESSION["s_mail"] = $_SESSION["s_mail"];
	$s_flg = true;
}
?>