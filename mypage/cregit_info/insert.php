<?php
	if($_POST["card_no"] == null || !isset($_POST["card_no"])){
		//$mess="カード番号を入力して下さい。";
        header("location:cregit.php?message=3");
        exit;
    }
    if($_POST["card_name"] == null || !isset($_POST["card_name"])){
    	//$mess="カードのご名義人様を入力して下さい。";
        header("location:cregit.php?message=4");
        exit;
    }
    /****************************
    ******* 　　変数　　************
    *****************************/

    session_start();
    $CustmerId = $_SESSION["CustmerId"];

    $credit_id = $CustmerId;//←sessionで持ってくる
    $flag = "";
    $registrant_id = "";
    $registrant_date = "";

    session_start();
    $CustmerId = $_SESSION["CustmerId"];


    $card_n = htmlspecialchars($_POST["card_no"], ENT_QUOTES);
    $card_h = htmlspecialchars($_POST["card_name"], ENT_QUOTES);
    $tuki = htmlspecialchars($_POST["tuki"], ENT_QUOTES);
    $nen = htmlspecialchars($_POST["nen"], ENT_QUOTES);
    $security = htmlspecialchars($_POST["code"], ENT_QUOTES);

    $card_d = $nen."-".$tuki."-00";
    /******************************
	*****  全角文字を半角に変換  ******
	*******************************/
	$card_n = mb_convert_kana($card_n,"as");
	$security = mb_convert_kana($security,"as");
	/******************************
	**********  チェック  ************
	*******************************/
	//番号
	if (!preg_match("/^[0-9]*$/", $card_n)){
		//$mess="カード番号に数字以外が記入されました。";
		header("location:cregit.php?message=11");
        exit;
	}
	/***************************
    ********  DB  **************
    ***************************/
    $host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";
	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	/***************************
    ********  SQL  *************
    ***************************/
	//sql文作成
	$sql = "INSERT into credit_m values('".$credit_id."','".$flag."','".$card_n."','".$card_h."','".$card_d."','".$security."','".$registrant_id."','".$registrant_date."')";
	echo $sql;
	//sql実行
	$res = mysql_query($sql , $con);
	echo $res;

	//結果メッセージ
	if (!$res) {
		//DB切断
		mysql_close($con);
		header("location:cregit.php?message=1");
		//$mess="同じユーザが２枚以上のカードを登録できません。";
	    exit;
	}else{
		//$message = mysql_error();
		mysql_close($con);
		header("location:cregit.php");
	    exit;
	}