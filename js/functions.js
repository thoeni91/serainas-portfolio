$(window).load(function() {

var $container = $('#grid-gallery .grid');
	// init
	$container.isotope({
	// options
	itemSelector: '.item',
	layoutMode: 'masonry'
});

// filter items on button click
$('#filters').on( 'click', 'a', function() {
 	var filterValue = $(this).attr('data-filter');
 	$container.isotope({ filter: filterValue });
});

 
 
});

