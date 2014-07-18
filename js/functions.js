$(window).load(function() {

var $container = $('#grid-gallery .grid');
	// init
	$container.isotope({
	// options
	itemSelector: '.item',
	layoutMode: 'masonry'
});
    
// init skrollr
s = skrollr.init({forceHeight: false, smoothScrollingDuration:100});
    
// run function for pilot image
getPilotImageHeight();
    
// set height for #work
$workHeight = $("#work").height() + 134;
/*$("#work").css("height", $workHeight);*/
    
// filter items on button click
$('#filters').on( 'click', 'a', function() {
 	var filterValue = $(this).attr('data-filter');
 	$container.isotope({ filter: filterValue }); 
 	$("#work").animateAuto("height", 300,function(){
    	skrollr.refresh($(".thumbnail"));
	});
});

// set selected menu items
   var $optionSets = $('#filters'),
       $optionLinks = $optionSets.find('a');
 
       $optionLinks.click(function(){
          var $this = $(this);
	  // don't proceed if already selected
	  if ( $this.hasClass('selected') ) {
	      return false;
	  }
   var $optionSet = $this.parents('#filters');
   $optionSet.find('.selected').removeClass('selected');
   $this.addClass('selected'); 
});

// smooth anchor scrolling
$('nav a').click(function(){
    $('html, body').animate({
        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top - 90
    }, 800);
    return false;
});

// init waypoint
$('#work').waypoint(function (direction) {
	if (direction == 'down') {
		$('#headerContent').addClass('fixed');
	}
	else {
		$('#headerContent').removeClass('fixed');
	}
}, { offset: '446px' });
    
// refresh skrollr after site loaded completely
s.refresh();

});

// on window resize
$( window ).resize(function() {
    getPilotImageHeight();
});

// functions

// get dimenions of pilot image and give it to .thumbnails
function getPilotImageHeight() {
    
    // get height of pilot image
    var $pilotHeight = $("#pilotImage").height();
    var $pilotWidth = $("#pilotImage").width();
    
    // if height is more than 800px
    if ($pilotHeight > 800) {
        // reduce it by 389px
        $pilotHeight = $pilotHeight - 389;
    }
    
    // check if width of pilot image is wider than 1920px
    if($pilotWidth > 1920) {
        $(".thumbnail").addClass("overWidth");
    } else {
         $(".thumbnail").removeClass("overWidth");    
    }
    
    // give it the height
    $(".thumbnail").css("height", $pilotHeight);
}
