<?php
	$movie_id = "1";
	if(isset($_GET["movie_id"])){
		$movie_id = htmlspecialchars($_GET["movie_id"], ENT_QUOTES);
	}
	if (!preg_match("/^[0-9]*$/", $movie_id)){
			header("Location:../index.php");
		}
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	//DBMS(MySQL)へ接続
	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );
	
	$sql = "SELECT s.movie_id ,title, description ,s.movie_start ,m.3d FROM movie_m AS m JOIN schedule AS s ON m.movie_id = s.movie_id WHERE m.movie_id = '$movie_id'";

	//sql実行
	$res = mysql_query($sql , $con);

	//DB切断
	mysql_close($con);

?>
<?php
include('../header.php');
?>
	<div id="main">
<?php
	while($row = mysql_fetch_array($res)){
		if( $row["3d"] ==0){
			$real = "なし";
		}else{
			$real = "あり";
		}
		echo "<div id=\"main\">";
			echo"<div id=\"main_img\">";
				echo "<img src='../img/moviePhoto/".$row['movie_id'].".jpg'\">";
			echo "</div>";
			echo "<div id=\"main_text\">";
				echo $row["title"];
				echo "<br>";
				echo $row["description"];
			echo "</div>";
			echo "<div class=\"clear\"></div>";
			echo "<div class=\"box2_text\">";
				echo "<div class=\"movieStart\">".$row["movie_start"]."～</div>";
				echo "3D上映".$real;
			echo "</div>";
		echo "</div>";
			}
?>
	</div><!-- main fin -->
	<div class="clear"></div>

	<div class="full_content">
   		<div class="menu active">9/1(月)</div>
 	  		<div class="content">
   			<div class="drag"><img src="../img/movie/men.png"></div>
			<div class="drag"><img src="../img/movie/girl.png"></div>
			<div class="drag"><img src="../img/movie/kuruma.png"></div>  
   			</div>
       
   		<div class="menu">9/2(火)</div>
   			<div class="content">
   			ここに内容が入ります。    
   		</div>
 
		<div class="menu">9/3(水)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
   
		<div class="menu">9/4(木)</div>
		   	<div class="content">
		   	ここに内容が入ります。    
		</div>
    
   		<div class="menu">9/5(金)</div>
   			<div class="content">
   			ここに内容が入ります。    
   			</div>
		</div>
<?php
include('../footer.php');
?>