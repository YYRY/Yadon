<?php
if($_GET["movie_id"] == null || !isset($_GET["movie_id"])){
        header("location:../index.php?aaa");
        exit;
}

$customer_id = "";
if(isset($_GET["movie_id"])){
    $movie_id = $_GET["movie_id"];
}

$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
mysql_select_db("iw32",$con);
mysql_query('SET NAMES utf8', $con );

$sql = "DELETE FROM movie_m WHERE movie_id = '$movie_id'";

$res = mysql_query($sql , $con);
$henkou = mysql_affected_rows();

if ($henkou ==0) {
    mysql_close($con);
    header("location:../index.php?message=1");
    exit;
}else{
    mysql_close($con);
    header("location:../index.php");
    exit;
}