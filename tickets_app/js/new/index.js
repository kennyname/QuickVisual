$(".btn1").click(
	function(){
		$(".page2").fadeIn(500);
		$(".container1").fadeOut(500);
		$(".logo").fadeOut(500);
});
$('.regist').click(function(){
	$('.login').fadeOut(500);
	$('.regist_form').fadeIn(1000);
	
})
$('.confirm').click(function(){
	$('.regist_form').fadeOut(1000);
})
