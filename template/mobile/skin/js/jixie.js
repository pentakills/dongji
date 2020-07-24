//比例
		 window.addEventListener('resize', Rem, false);
	    Rem();
			function Rem() {
	      var docEl = document.documentElement,
	        oSize = docEl.clientWidth / 7.5;
	      if (oSize > 100) {
	        oSize = 100; //  限制rem值   640 / 6.4 =100
	      }
	      docEl.style.fontSize = oSize + 'px';
			}
			

$(function(){
	$(".nva-list dl").hide();
	$(".nva-list li").click(function(){
		$(this).next("dl").stop().slideToggle(500).siblings("dl").stop().slideUp(500);
		$(this).stop().toggleClass("nvaChange").siblings(".nva-list li").removeClass("nvaChange");
	});
	$(".nva-btn").click(function(){
		$(".nva-box").stop().toggleClass('nva-dh')
	});
	$(".zy-list ul").hide()
	$(".zy-list h2").click(function(){
		$(this).stop().toggleClass('zy-bt');
		$(".zy-list ul").stop().slideToggle(500);
	})
})