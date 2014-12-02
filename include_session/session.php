<?php
//セッションフラグ
$s_flg = false;

//セッションスタート
session_start();

//セッションが無い状態
if( !isset( $_SESSION["c_id"] ) || $_SESSION["c_id"] == null ){

}
//セッションがあった
else{
	$c_id = $_SESSION["c_id"];
	$s_flg = true;
}
?>