/**
 * handling Custom Jquery and Javascript Featuers
 * @author Nadeem <www.webtechapps.com>
 */
var scrollDuration = 500;
 $('document').ready(function(){
 	$("#down-main-section").click(function() {
	    $('html, body').animate({
	        scrollTop: $(".brands-section").offset().top
	    }, scrollDuration);
	    return false;
	});
});