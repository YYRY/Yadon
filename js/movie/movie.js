window.onload = function(){

//座席クリック
$("td").not(".none").click(function(){

	var this_td = $(this);
	
	//座席の色を戻す
	if(this_td.css('z-index') == '101'){
		//普通席
		$(this).css({
			"background":"#ddd",
			"z-index":"100"
		});
	}
	else if(this_td.css('z-index') == '103'){
		//車椅子
		$(this).css({
			"background":"#0CF",
			"z-index":"102"
		});
	}
	else if(this_td.css('z-index') == '105'){
		//ペアシート
		$(this).css({
			"background":"#52e26d",
			"z-index":"104"
		});
	}
	
	//座席予約クリック
	else{
		if(this_td.css('z-index') == '100'){
		//普通席クリック
		$(this).css({
			"background":"#fc9d50",
			"z-index":"101"
		});
		}
		//車椅子席クリック
		else if(this_td.css('z-index') == '102'){
			$(this).css({
				"background":"#fc9d50",
				"z-index":"103"
			});
		}
		//ペアシートクリック
		else if(this_td.css('z-index') == '104'){
			$(this).css({
				"background":"#fc9d50",
				"z-index":"105"
			});
		}
		
		var yoyaku = this_td.text();
		var sei = "男性";
		var yen = "1800";
		$("#yoyaku").append("予約座席："+yoyaku+"　"+sei+"　"+yen+"円<br />");
	}

});




}