$(function () {
    $(".load_more").slice(0, 12).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div:hidden").slice(0, 4).slideDown();
        if ($("div:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
  		  if ( $( ".load_more:last" ).css('display') == 'block' ) {
			$('#loadMore').hide();
			$('.totop').show();
		  }  
    });    
});

if( $('a[href="#top"]').length > 0 ){
	$('a[href="#top"]').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
}

$(window).scroll(function () {
    if ($(this).scrollTop() > 50) {
        $('.totop a').fadeIn();
    } else {
        $('.totop a').fadeOut();
    }
});