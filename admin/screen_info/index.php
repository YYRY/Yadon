<?php
	$host_name = "localhost";
	$dbms_user = "root";
	$dbms_pass = "";

	$con = mysql_connect($host_name,$dbms_user,$dbms_pass);
	mysql_select_db("iw32",$con);
	mysql_query('SET NAMES utf8', $con );

	/*******************************
	*********   update   **************
	********************************/
	if(isset($_POST["submit_upd"])){
		$no = key($_POST["submit_upd"]);

		if($_POST["3d"][$no] == "あり"){
			$three_d = 1;
		}elseif($_POST["3d"][$no] == "なし"){
			$three_d = 0;
		}

		$movie_id    = htmlspecialchars($_POST["movie_id"][$no],ENT_QUOTES);
		$movie_name  = htmlspecialchars($_POST["title"][$no],ENT_QUOTES);
		$description = htmlspecialchars($_POST["description"][$no],ENT_QUOTES);

		$sql = "UPDATE movie_m SET movie_id='$movie_id',title='$movie_name',description='$description',3d='$three_d',registrant_id='',registered_date='' WHERE movie_id='$no'";
		$res = mysql_query($sql,$con);
	}
?>
<style>
.cus-section{
	width:960px;
	margin:0 auto;
	padding: 20px 10px;
}
.cus-section table{
	font-size: 12px;
    margin: 0 auto;
    border-collapse: separate;
    border-spacing: 0px 1px;
}
.cus-section td{
	padding: 12px;
    vertical-align: middle;
    text-align: left;
    border-bottom: #999 1px solid;
    font-size: 11px;
}
.cus-section table input[type="text"]#title{
	width: 300px;
}
.cus-section table input[type="text"]#three_d{
	width: 30px;
}
.cus-section table textarea{
	width: 260px;
	height: 4em;
}
.cus-section table span{
	color: #ee2222;
}
.cus-section table span:hover{
	text-shadow:1px 1px 1px;
}
.cus-section table .del{
	cursor: pointer;
}
</style>
	<section class="cus-section">
		<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
		<table>
			<tr>
				<th>映画ID</th>
				<th>タイトル</th>
				<th>３D上映</th>
				<th>説明</th>
				<th>変更</th>
				<th>削除</th>
			</tr>
<?php
	$sql = "SELECT * FROM movie_m";
	$max_movie_id = "SELECT MAX(movie_id) FROM movie_m";
	$mres = mysql_query($max_movie_id , $con);

	$new_max_movie_id = @mysql_fetch_assoc($mres);
	$new_max_movie_id = $new_max_movie_id['MAX(movie_id)'] + 1;

	$res = mysql_query($sql , $con);
	$customer_num = mysql_num_rows($res);

	if($customer_num > 0){
		while($row = mysql_fetch_array($res)){
			$movie_id    = $row["movie_id"];
			$title       = $row["title"];
			$three_d     = $row["3d"];
			$description = $row["description"];
			$three_d_c   = "color:#000;";
			if($three_d == "1"){
				$three_d   = "あり";
				$three_d_c = "color:#f00;";
			}else if($three_d == "0"){
				$three_d   = "なし";
				$three_d_c = "color:#00f;";
			}
$string = <<< EOM
<td><input type="hidden" name="movie_id[$movie_id]" value="$movie_id">$movie_id</td>
<td><input type="text"   name="title[$movie_id]" value="$title" id="title"></td>
<td><input type="text"   name="3d[$movie_id]" value="$three_d" style="$three_d_c" id="three_d"></td>
<td><textarea name="description[$movie_id]">$description</textarea></td>
<td><input type="submit" name="submit_upd[$movie_id]" value="変更" class='upd'></td>
<td><span onclick='del(${movie_id})' title='削除する。' class='del'>X</span></td>
</tr>
EOM;
	echo $string;
		}
	}else{
		echo "<td>映画情報がありません。</td></tr>";
	}	
?>
		</form>
		</table>
		<hr>
		<form action="php/movie_add.php" method="POST">
			<table>
				<tr>
					<td><input type="hidden" name="movie_id" value="<?=$new_max_movie_id?>"><?=$new_max_movie_id?></td>
					<td><input type="text"   name="title" value="" id="title"></td>
					<td><input type="text"   name="3d" value="" id="three_d"></td>
					<td><textarea name="description"></textarea></td>
					<td><input type="submit" name="" value="送信" class='upd'></td>
					<td>　</td>
			</table>
			<a href='../index.php'>戻る</a>
		</form>

	</section>
<script type="text/javascript">
function del(n){
	if(confirm("削除しますか？")){
		location.href = "php/movie-del.php?movie_id="+n;
	}
}
</script>
<?php
// include('../footer.php');
?>