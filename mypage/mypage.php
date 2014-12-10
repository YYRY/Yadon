<?php
include ('../header.php');
$customer_id = $c_id;
$customer_id = 4;//$_SESSION["c_id"];

?>
	<article>
		<section class="left-cont">
			<div><a href="user_info/user.php?customer_id=<?php echo $customer_id?>">ユーザ情報</a></div>
			<div><a href="history_info/history.php">購入履歴</a></div>
			<div><a href="cregit_info/cregit.php">クレジットカード情報</a></div>
			<div><a href="mail_info/mail.html">メルマガ登録・変更</a></div>
			<div><a href="user_deleate.php?customer_id=<?php echo $customer_id?>">退会する</a></div>
		</section>
		<section class="right-cont">
			<div>有用情報</div>
		</section>
		<div class="cl"> </div>
	</article>
<?php
include '../footer.php';
?>