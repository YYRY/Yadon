
$(function(){
	$(".content:not('.active + .content')").hide();       
	$(".menu").hover(function(){
		$(this).addClass("hover")
    },
    function(){
		$(this).removeClass("hover")
	});    
    $(".menu").click(function(){
		$(".menu").removeClass("active");
        $(this).addClass("active");
        $(".content:not('.active + .content')").fadeOut();
        $(".active + .content").fadeIn();     
    });
});



