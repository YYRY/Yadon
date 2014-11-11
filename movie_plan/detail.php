<!DOCTYPE html>
<html>
	<head>
	<title>上映予定作品詳細</title>
	<meta charset="utf-8">
	<meta name="keywords" content="HALシネマ東京"><!-- ＳＥＯ対策　-->
	<meta name="description" content="HALシネマのサイトです">
	<meta name="author" content="Kaito Shidara" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<link rel="apple-touch-icon" href="img/icon/" /><!-- スマホで見るなら -->
	<!--  css  -->
	<link href="../css/common.css" rel="stylesheet" type="text/css">
	<link href="../css/movie/movie.css" rel="stylesheet" type="text/css">
	<!--  js  -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript">
	$ (function(){
        $ (".content:not('.active + .content')").hide();       
        $(".menu").hover(function(){
                $ (this).addClass("hover")
        },
        function(){
                $(this).removeClass("hover")
        });    
        $ (".menu").click(function(){
                $(".menu").removeClass("active");
                $ (this).addClass("active");
                $(".content:not('.active + .content')").fadeOut();
        $ (".active + .content").fadeIn();     
        });

	//drag
	$(".drag").draggable({
		snap:".snap"
	});

});
	</script>
	</head>
<body>
			<!-- ヘッダー -->
		<header>
			<h1><img src="../img/logo.png" alt="ハルシネマ"></h1>
			<p>キャッチコピー</p>

			<ul>
				<li><a href="" title="お問い合わせ"><img src="" width="50" height="50" alt="お問い合わせ"></a></li>
				<li><a href="" title="Q &amp; A"><img src="" width="50" height="50" alt="Q &amp; A"></a></li>
				<li><a href="" title="サイトマップ"><img src="" width="50" height="50" alt="サイトマップ"></a></li>
				<li><a href="" title="ログイン"><img src="" width="50" height="50" alt="ログイン"></a></li>
			</ul>
		</header>

		<!-- ナビゲーション -->
		<nav>
			<ul>
				<li><a href="">上映中作品一覧</a></li>
				<li><a href="">お知らせ</a></li>
				<li><a href="">上映予定作品一覧</a></li>
				<li><a href="">料金</a></li>
				<li><a href="">割引サービス</a></li>
				<li><a href="">アクセス方法</a></li>
			</ul>
		</nav>
	<div id="main">
		<div id="main_img">
			<img src="../../../映画情報/1.jpg" width="300px" height="150px">
		</div>

		<div id="main_text">
		ノア　約束の舟<br />
		<p>
			ある夜、ノアは眠りの中で、恐るべき光景を見る。それは、堕落した人間を滅ぼすために、すべてを地上から消し去り、新たな世界を創るという神の宣告だった。大洪水が来ると知ったノアは、家族と共に、罪のない動物たちを守る箱舟を作り始める。やがて大洪水が始まる。空は暗転し激しい豪雨が大地に降り注ぎ、地上の水門が開き水柱が立ち上がる。濁流が地上を覆う中、ノアの家族と動物たちを乗せた箱舟だけが流されていく。閉ざされた箱舟の中で、ノアは神に託された驚くべき使命を打ち明ける。箱舟に乗ったノアの家族の未来とは？ 人類が犯した罪とは？そして世界を新たに創造するという途方もない約束の結末とは──？
		</p>
		</div>
	<div class="clear"></div>
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

			<!-- フッター -->
		<footer>
			<section>
				<h3>分類１</h3>
				<ul>
					<li><a href="">プライバシーポリシー</a></li>
					<li><a href="">プライバシーポリシー</a></li>
					<li><a href="">プライバシーポリシー</a></li>
				</ul>
			</section>
			<section>
				<h3>分類２</h3>
				<ul>
					<li><a href="">特定商取引法に基づく表記</a></li>
					<li><a href="">特定商取引法に基づく表記</a></li>
					<li><a href="">特定商取引法に基づく表記</a></li>
				</ul>
			</section>
			<section>
				<h3>分類３</h3>
				<ul>
					<li><a href="">ご利用に際して</a></li>
					<li><a href="">ご利用に際して</a></li>
					<li><a href="">ご利用に際して</a></li>
				</ul>
			</section>

			<p><small>&copy; 2014 HAL Cinema Ltd. All Rights Reserved.</small></p>
		</footer>
</body>
</html>