function menuHide(){
	$("#main-nav").hide();
	$('#main-content').css('margin-left','0px');
	$('body').css('overflow','auto');
}
function menuShow(){
	$("#main-nav").show();
	$('#main-content').css('margin-left','240px');
	$('body').css('overflow','hidden');
}
$(document).mouseup(function (e)
{
    var container = $("#main-nav");
    var container2 = $('.menu-m-show');

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0 && !container2.is(e.target)) // ... nor a descendant of the container
    {
        //container.hide();
        menuHide();
    }
});
$('.menu-m-show').click(function(){
	if($("#main-nav").css('display') == 'none')
	{
		menuShow();
	}
	else
	{
		menuHide();
	}	
	//$('#main-nav').toggle();
	
});
var windowsize = $(window).width();

$(window).resize(function() {
  windowsize = $(window).width();
  if (windowsize > 1024) {
    //if the window is greater than 440px wide then turn on jScrollPane..
      $('#main-nav').css('display','block');
      $('body').css('overflow','auto');
      $('#main-content').css('margin-left','240px');
  }
  if (windowsize < 1024) {
    //if the window is greater than 440px wide then turn on jScrollPane..
      $('#main-nav').css('display','none');
      $('body').css('overflow','auto');
      $('#main-content').css('margin-left','0px');
  }
});