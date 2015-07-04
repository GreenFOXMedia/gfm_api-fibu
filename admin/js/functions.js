$(document).ready(function(){
	$(".submenu").hover(function(){
		$(this).find("ul").toggleClass("submenu-visible");
	});

	$(".admin-menu li a").each(function(){
		if(document.URL.indexOf($(this).attr("href")) != -1) {
    		$(this).parent().addClass("active");
		}
	})

	$(".submenu").has(".active").addClass("active");
})