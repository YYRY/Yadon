<?php
if($_POST["title"] == null || !isset($_POST["title"])){
    header("location:../index.php?aaa");
    exit;
}

$movie_id = "";
if(isset($_POST["movie_id"])){
    $movie_id    = htmlspecialchars($_POST["movie_id"], ENT_QUOTES);
    $title       = htmlspecialchars($_POST["title"], ENT_QUOTES);
    $three_d     = htmlspecialchars($_POST["3d"], ENT_QUOTES);
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES);

    if($three_d == "あり"){
		$three_d = 1;
	}elseif($three_d == "なし"){
		$three_d = 0;
	}

	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
    mysql_query('SET NAMES utf8', $con );

	$sql = "INSERT into movie_m values('".$movie_id."','".$title."','".$description."','".$three_d."','','')";
	$res = mysql_query($sql , $con);
	$henkou = mysql_affected_rows();

}else{
	$url = "../index.php?mess=4";
}
if ($henkou ==0) {
    mysql_close($con);
    header("location:../index.php?message=1");
    exit;
}else{
    mysql_close($con);
    header("location:../index.php");
    exit;
}