$(window).load(function() {
    
// start functions
startFunctions();

var $container = $('#grid-gallery .grid');
	// init
	$container.isotope({
	// options
	itemSelector: '.item',
	layoutMode: 'masonry'
});
    
    
if (screen.width > 800) {
    // init skrollr
    s = skrollr.init({forceHeight: false, smoothScrolling:false, smoothScrollingDuration:300});
}
    
// run function for pilot image
getPilotImageHeight();
    
// set height for #work
workHeight = $("#work").height() + 134;
$("#work").css("height", workHeight);
    
// filter items on button click
$('#filters').on( 'click', 'a', function() {
 	var filterValue = $(this).attr('data-filter');
 	$container.isotope({ filter: filterValue }); 
 	$("#work").animateAuto("height", function() {
        setPageWaypoints();
        s.refresh();
    });
});

$('select').change(function(){
 	var filterValue = $(this).find(':selected').attr('data-filter');
 	$container.isotope({ filter: filterValue }); 
 	$("#work").animateAuto("height", function() {
        setPageWaypoints();
        s.refresh();
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
$('header a').click(function(){
    $('html, body').animate({
        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top - 89
    }, 1200);
    return false;
});
    
// hide arrow on scroll
$('body').waypoint(function (direction) {
    if (direction == 'down') {
        $('#arrow').fadeOut();
    }
    else {
       $('#arrow').fadeIn();
    }
}, { offset: '-1px' });
    

    
// IE special treatment
var doc = document.documentElement;
doc.setAttribute('data-useragent', navigator.userAgent);
    
// refresh skrollr after page loaded completely
s.refresh();

});

// on window resize
$( window ).resize(function() {
    startFunctions();
    getPilotImageHeight();
    s.refresh();
});

// functions

function startFunctions() {
    browserHeight = $(window).height();
    headerContentWidth = $("#headerContent").width();
    headerContentHeight = $("#headerContent").height();
    workImageWidth = $(".grid-wrap figure img").width();
    
    // work item title pos
    $(".grid-wrap figure .title").css("width", workImageWidth);
    
    // headerimage height
    $("header, #headerImage").css("height", browserHeight + "px");
    $("#headerImage").fadeIn();
    // header margin
    $("header").css("margin-bottom", "-" + browserHeight + "px");
    
    // headerContent stuff
    $("#headerContent").css("margin-top", "-" + headerContentHeight/2 + "px");
    $("#headerContent").attr("data-start", "top:" + (browserHeight/2) + "px");
    $("#headerContent").fadeIn();
    
    // main-container offset from top
    $("#main-container").css("top", (browserHeight+22) + "px");
    
    // grid gallery slideshow height
    detailsHeight = $(".slideshow ul li .left .details").height(); 
    $(".slideshow ul li .left .excerpt").css("height", (browserHeight-detailsHeight-200) + "px"); 
    $(".slideshow ul li .right").css("max-height", (browserHeight-180) + "px");
    
    // logo height
    $("#headerContent #logo img").css("height", "auto");
    logoHeight= $("#headerContent #logo img").height();
    $("#headerContent #logo img").css("height", logoHeight);
    
    // set nav point for scrolling elements
    setNavWaypoint();
    setPageWaypoints();
}

function setNavWaypoint() {
    // init waypoint
    $('#work').waypoint(function (direction) {
        if (direction == 'down') {
            $('#headerContent').addClass("scrolled");
            
            $("#headerContent #logo img").fadeOut(function() {
                $(this).attr("src", template_url + "/images/serainacavigelli_navy.svg").fadeIn();
            });
            
            $('#headerContent nav a').css('color', "#273a4f");
        }
        else {
            $('#headerContent').removeClass("scrolled");
            $("#headerContent #logo img").fadeOut(function() {
                $(this).attr("src", template_url + "/images/serainacavigelli_weiss.svg").fadeIn();
            });
            $('#headerContent nav a').css("color", "#fff").css("border", "none");
        }
    }, { offset: '100px' });
}

function setPageWaypoints() {
    // waypoints for navigation (give border to active one)
    $('#work, .page').waypoint(function (direction) {
        if (direction == 'down') {
            $('#headerContent nav li a').css('border', 'none'); 
            pageID = $(this).attr("id");
            $('#headerContent nav li.' + pageID + ' a').css('border-bottom', "1px solid #273a4f"); 
        }
    }, { offset: '100px' }); 
    
    // same function, but on scroll up
    $('.page').waypoint(function (direction) {
        if (direction == 'up') {
            $('#headerContent nav li a').css('border', 'none'); 
            pageID = $(this).attr("id");
            $('#headerContent nav li.' + pageID + ' a').css('border-bottom', '1px solid #273a4f'); 
        }
    }, { offset: 'bottom-in-view' });
    
    // same function for work, but with different offset (if container gets too small work would be active on top)
    $('#work').waypoint(function (direction) {
        if (direction == 'up') {
            $('#headerContent nav li a').css('border', 'none'); 
            pageID = $(this).attr("id");
            $('#headerContent nav li.' + pageID + ' a').css('border-bottom', '1px solid #273a4f'); 
        }
    }, { offset: '0%' });
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
