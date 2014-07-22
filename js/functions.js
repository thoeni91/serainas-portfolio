$(window).load(function() {
    
// make headerImage same height as browser
setHeaderImageHeight();

var $container = $('#grid-gallery .grid');
	// init
	$container.isotope({
	// options
	itemSelector: '.item',
	layoutMode: 'masonry'
});
    
// init skrollr
s = skrollr.init({forceHeight: false, smoothScrolling:false, smoothScrollingDuration:300});
    
// run function for pilot image
getPilotImageHeight();
    
// set height for #work
$workHeight = $("#work").height() + 134;
$("#work").css("height", $workHeight);
    
// filter items on button click
$('#filters').on( 'click', 'a', function() {
 	var filterValue = $(this).attr('data-filter');
 	$container.isotope({ filter: filterValue }); 
 	$("#work").animateAuto("height", 300);
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

setNavWaypoint();
    
    
/*// infinite scroll super function 
$container.infinitescroll({
    navSelector  : "#pageNav",            
    // selector for the paged navigation (it will be hidden)
    nextSelector : "#pageNav a",    
    // selector for the NEXT link (to page 2)
    itemSelector : "#work .item",        
    // selector for all items you'll retrieve
    loadingImg   : "/img/loading.gif",          
                 // loading image.
                 // default: "http://www.infinite-scroll.com/loading.gif"
    loadingText  : "",      
                 // text accompanying loading image
                 // default: "<em>Loading the next set of posts...</em>"
    donetext     : "",
                 // text displayed when all items have been retrieved
                 // default: "<em>Congratulations, you've reached the end of the internet.</em>"
  },
  // trigger isotope as a callback
  function( newElements ) {
    var $newElems = $( newElements );
    $container.isotope( 'appended', $newElems );
    $("#work").animateAuto("height", 300);
  }
);

var $slideshowContainer = $('.slideshow ul');
$slideshowContainer.infinitescroll({
    navSelector  : "#pageNav",            
    // selector for the paged navigation (it will be hidden)
    nextSelector : "#pageNav a",    
    // selector for the NEXT link (to page 2)
    itemSelector : "#work .itemPopup",        
    // selector for all items you'll retrieve
    loadingImg   : "",          
                 // loading image.
                 // default: "http://www.infinite-scroll.com/loading.gif"
    loadingText  : "",      
                 // text accompanying loading image
                 // default: "<em>Loading the next set of posts...</em>"
    donetext     : "",
                 // text displayed when all items have been retrieved
                 // default: "<em>Congratulations, you've reached the end of the internet.</em>"
  });*/
    
// refresh skrollr after page loaded completely
s.refresh();

});

// on window resize
$( window ).resize(function() {
    setHeaderImageHeight();
    getPilotImageHeight();
});

// functions

function setHeaderImageHeight() {
    browserHeight = $(window).height();
    $("#headerImage").css("height", browserHeight + "px");
    $("#headerContent").css("line-height", browserHeight + "px");
    $("#main-container").css("top", (browserHeight+22) + "px"); 
    setNavWaypoint();
}

function setNavWaypoint() {
    // init waypoint
    $('#headerContent').removeClass('fixed');
    $('#work').waypoint(function (direction) {
        if (direction == 'down') {
            $('#headerContent').addClass('fixed');
        }
        else {
            $('#headerContent').removeClass('fixed');
        }
    }, { offset: browserHeight/2+46 + 'px' }); 
}

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
