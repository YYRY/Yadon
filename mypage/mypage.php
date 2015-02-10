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
			<div onclick="del('${customer_id}');"><a href="user_deleate.php?customer_id=<?php echo $customer_id?>">退会する</a></div>
		</section>
<script type="text/javascript" src="../js/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/qr/jquery.qrcode.min.js"></script>
<script type="text/javascript">
function del(n){
	if(confirm("本当に退会しますか？")){
		location.href = "user_deleate.php?customer_id="+n;
	}
}

$(document).ready(function(){
     $('#qr').qrcode({		//demo2:幅や高さを指定する場合
         width:100,				//QRコードの幅
         height:100,			//QRコードの高さ
         text:'http://hal.ovdesign.jp/md31/fujita/iw32/qr.php?c_id=<?= $customer_id ?>'			//QRコードの内容
   });
});
</script>
		<section class="right-cont">
        	映画入場用QRコード<br />
            <div id="QRarea">
                <div id="qr"></div>
            </div>
		</section>
		<div class="cl"> </div>
	</article>
<?php
include '../footer.php';
?>