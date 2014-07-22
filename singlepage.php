<?php

/*
Template Name: Single Page Layout
*/

$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;

 // WP_Query arguments
$work_args = array (
	'post_type'			=> 'work',
    'posts_per_page'    => 2,
    'paged'             => $paged
);

// The Query
$work_query = new WP_Query( $work_args );

// Pagination fix
$temp_query = $wp_query;
$wp_query   = NULL;
$wp_query   = $work_query;

get_header(); ?>

<div id="main-container" class="zigzagTop">
	
<div id="work" name="work">

<!-- Get the taxonomy list of 'types' -->
<?php
$args = array( 'hide_empty=true' );

$terms = get_terms('types', $args);
if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
    $count = count($terms);
    $i=0;
    $term_list = '<div id="filters"><a data-filter="*">Alle</a>';
    foreach ($terms as $term) {
        $i++;
    	$term_list .= '<a data-filter=".' . $term->slug . '" title="' . sprintf(__('Filtern nach %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
    }
    $term_list .= '</div>';
    echo $term_list;
}
?>

<!-- Google Grid Gallery starts here -->
<div id="grid-gallery" class="grid-gallery">
	<section class="grid-wrap">
		<ul class="grid">
			<li class="grid-sizer"></li><!-- for Masonry column width -->
	
			<!-- Loop the 'work' items -->
			<?php if ( $work_query->have_posts() ) : while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
			
			<?php
			//Get the types specified for this post
			$terms = get_the_terms( $post->ID, 'types' );
									
			if ( $terms && ! is_wp_error( $terms ) ) : 
			
				$work_types_links = array();
			
				foreach ( $terms as $term ) {
					$work_types_links[] = $term->slug;
				}
									
				$work_types = join( " ", $work_types_links );
			?>
			<?php endif; ?>
			
			<!-- Item, with specified types as class -->
			<li id="item-<?php the_id(); ?>" class="item <?php echo $work_types; ?>">
				<figure>
                    <div class="title"><?php the_title(); ?></div>
					<?php 
						if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail('work-small');
						} 
					?>
				</figure>
			</li>
			
			
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
	
		</ul>
        
        
		
		<div id="pageNav">
            <?php
                // Reset postdata
                wp_reset_postdata();

                // Custom query loop pagination
                next_posts_link( 'Older Posts', $work_query->max_num_pages );

                // Reset main query object
                $wp_query = NULL;
                $wp_query = $temp_query;
            ?>
		</div>
	</section><!-- // grid-wrap -->
	
	<!-- Reset Loop -->
	<?php rewind_posts(); ?>
	
	<section class="slideshow">
		<nav>
			<span class="nav-prev">< vorheriges Projekt</span>
			<span class="nav-close">x schliessen</span>
			<span class="nav-next">nächstes Projekt ></span>
		</nav>
		<ul>
	
		<!-- Loop them again for the slideshow, whoop whoop -->
		<?php if ( $work_query->have_posts() ) : while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
		
		<?php
			// Read the post metas
			$leistungen = get_post_meta( $post->ID, 'leistungen', true );
			$auftrag = get_post_meta( $post->ID, 'auftrag', true );
			$status = get_post_meta( $post->ID, 'status', true );
		?>
	
			<li id="singleItem-<?php the_id(); ?>" class="itemPopup">
				<figure onclick="window.event.cancelBubble = true">
					<div class="left">
						<div class="details">
							<h2><?php the_title(); ?></h2>
							<?php if( !empty( $leistungen ) ) { ?>
								<h3>Leistungen</h3>
								<p><?php echo $leistungen; ?></p>
							<?php } ?>
							<?php if( !empty( $auftrag ) ) { ?>
								<h3>Auftrag</h3>
								<p><?php echo $auftrag; ?></p>
							<?php } ?>
							<?php if( !empty( $status ) ) { ?>
								<h3>Status</h3>
								<p><?php echo $status; ?></p>
							<?php } ?>
						</div>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<div class="right">
						<div class="content">
						<?php the_content(); ?>
					</div>
				</figure>
			</li>
	
		<?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	
		</ul>
	</section><!-- // slideshow -->
</div><!-- grid-gallery -->
</div><!-- work -->

<div class="clear"></div>

<div id="about">
<?php
	// get content of this page
    // WP_Query arguments
	$args = array (
		'pagename'               => 'about',
		'post_type'              => 'page',
		'pagination'             => false,
	);

	// The Query
	$about = new WP_Query( $args );

	// The Loop
	if ( $about->have_posts() ) {
		while ( $about->have_posts() ) {
			$about->the_post();
?>
	<div class="zigzag-box"></div>
	<?php $thumbnailUrl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'page-thumbnail'); ?>

    <img id="pilotImage" src="<?php bloginfo('template_url'); ?>/images/pilot.jpg" alt="Pilot" style="position:absolute; width:100%; height:auto; z-index:-10;" />
	<div class="thumbnail" style="background-image:url(<?php echo $thumbnailUrl[0]; ?>)"
		data-bottom-top="background-position: 50% 0px;"
        data-top-bottom="background-position: 50% -400px;"></div>
        
        
    <!-- plan: unsichtbares image, dann höhe auslesen und übertragen -->
    <!-- <img width="1600" height="1200" style="width:100%; height:auto;" /> -->
	
	<div id="aboutContent" class="content" name="about">
		<h2><?php the_title(); ?></h2>
		<?php the_content(); ?>
	</div>
	<div class="zigzag-box"></div>
	
	<div class="thumbnail" style="background-image:url(<?php if (class_exists('MultiPostThumbnails')) : echo MultiPostThumbnails::get_post_thumbnail_url(get_post_type(), 'page-thumbnail-below', NULL,  'page-thumbnail'); endif; ?>)"
		data-bottom-top="background-position: 50% 0px;"
        data-top-bottom="background-position: 50% -400px;"></div>
		
	<?php }} else { ?>
	
	<div>Du hast die About Seite gelöscht... *facepalm*</div>
	
	<?php }
	
	// Restore original Post Data
	wp_reset_postdata();
?>

</div><!-- about -->


<?php get_footer(); ?>