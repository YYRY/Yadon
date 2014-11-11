$( function() {
	
	// スライドする要素を取得
	var $main    = $( '.main-visual' );
	
	$main.each( function() {
		
		var $visuals = $(this).find( '> ul > li' );
		var count    = $visuals.length;
		var now_idx  = 0;
		var h        = 0;
		
		var interval = 7500;
		var timer;
		
		var indicatorHTML = '';
		var navHTML       = '';
		
		//
		// インジケータの生成
		//
		indicatorHTML = '<div class="indicator">';
		$visuals.each( function ( i ) {
			
			indicatorHTML += '<button><img src="./img/cercle.png" alt="メインビジュアル' + ( i + 1 ) + '番目"></button>';
			
		} );
		indicatorHTML += '</div>';
		$( this ).append( indicatorHTML );
		var $indicator = $( this ).find( '> .indicator > button' );
		
		
		//
		// ナビゲーションの生成
		//
		navHTML  = '<button class="prev"><img src="./img/prev.png" alt="Prev"></button>';
		navHTML += '<button class="next"><img src="./img/next.png" alt="Next"></button>';
		$( this ).append( navHTML );
		var $nav = $( this ).find( '> button' );
		
		
		//
		// メインビジュアルのすべてを非表示と表示位置を変更
		// (script無効の際は、すべてが表示されたまま)
		//
		$visuals.css( {
			  'display'  : 'none'
			, 'position' : 'absolute'
			, 'top'      : 'calc(50% - 360px / 2)'
			, 'left'     : 'calc(50% - 640px / 2)'
		} );
		
		
		//
		// 任意のスライドを表示する
		//
		function goToSlide( index ) {
			
			// 現在のスライドをフェードアウトで非表示
			$visuals.eq( now_idx ).fadeOut();
			
			// 次のスライドをフェードインで表示
			$visuals.eq( index ).fadeIn();
			
			// 現在のスライドを更新
			now_idx = index;
			
			// インジケータの状態を更新
			updateIndicator();
			
		}
		
		
		//
		// スライドの状態でインジケータを更新する
		//
		function updateIndicator(  ) {
			
			$indicator.removeClass( 'active' ).eq( now_idx ).addClass( 'active' );
			
		}
		
		
		//
		// タイマーを開始する
		//
		function startTimer(  ) {
			
			timer = setInterval( function (  ) {
				
				var next_idx = ( now_idx + 1 ) % count;
				goToSlide( next_idx );
				
			}, interval );
			
		}
		
		
		//
		// タイマーを停止する
		//
		function stopTimer(  ) {
			
			clearInterval( timer );
			
		}
		
		
		//
		// イベントの登録( ナビゲーションがクリックされた )
		//
		$nav.on( 'click',  function ( event ) {
			
			var next_idx;
			
			event.preventDefault();
			
			if ( $(this).hasClass( 'prev' ) ) {
				next_idx = ( now_idx - 1 ) % count;
			} else {
				next_idx = ( now_idx + 1 ) % count;
			}
			goToSlide( next_idx );
			
		} );
		
		
		//
		// イベントの登録( インジケータがクリックされた )
		//
		$indicator.on( 'click', function ( event ) {
			
			event.preventDefault();
			if ( !$(this).hasClass( 'active' ) ) {
				goToSlide( $(this).index() );
			}
			
		} );
		
		
		//
		// マウスが乗ったらタイマーを停止
		//
		$( this ).on( {
			'mouseenter' : stopTimer, 
			'mouseleave' : startTimer
		} );
		
		
		//
		// スライドショーの開始
		//
		goToSlide( now_idx );
		startTimer();
		
	} );
} );
