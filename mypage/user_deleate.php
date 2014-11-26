<?php
if($_GET["customer_cd"] == null || !isset($_GET["customer_cd"])){
        header("location:mypage.php");
        exit;
}
if(isset($_GET["customer_cd"])){
    $customer_cd = $_GET["customer_cd"];
}

$host_name = "localhost";
$dbms_user = "root";
$dbms_pass = "";

$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
mysql_select_db("iw32",$con);

$sql = "DELETE FROM customer_m WHERE customer_id = '$customer_cd'";

$res = mysql_query($sql , $con);
$henkou = mysql_affected_rows();

if ($henkou ==0) {
    mysql_close($con);
    header("location:mypage.php?message=1");
    exit;
}else{
    mysql_close($con);
    header("location:mypage.php");
    exit;
}