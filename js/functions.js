$(window).load(function() {

var $container = $('#grid-gallery .grid');
	// init
	$container.isotope({
	// options
	itemSelector: '.item',
	layoutMode: 'masonry'
});

// set height for #work
var $workHeight = $("#work").height() + 134;
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
        scrollTop: $('[name="' + $.attr(this, 'href').substr(1) + '"]').offset().top
    }, 500);
    return false;
});

});