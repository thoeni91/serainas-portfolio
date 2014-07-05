<?php

// WP_Query arguments
$work_args = array (
	'post_type'	=> 'work',
);

// The Query
$work_query = new WP_Query( $work_args );

get_header(); ?>

<div id="main-container">
	
	<div id="work" name="work">
	
	<!-- Get the taxonomy list of 'types' -->
	<?php
	$args = array( 'hide_empty=0' );

	$terms = get_terms('types', $args);
	if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
	    $count = count($terms);
	    $i=0;
	    $term_list = '<div id="filters">';
	    foreach ($terms as $term) {
	        $i++;
	    	$term_list .= '<a data-filter=".' . $term->slug . '" title="' . sprintf(__('Filtern nach %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';
	    }
	    $term_list .= '</div>';
	    echo $term_list;
	}
	?>
	
	<div id="grid-gallery" class="grid-gallery">
		<section class="grid-wrap">
			<ul class="grid">
				<li class="grid-sizer"></li><!-- for Masonry column width -->
		
				<!-- Loop the items for the first time -->
				<?php if ( $work_query->have_posts() ) : while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
				
				<li id="item-<?php the_id(); ?>" class="item <?php $terms = wp_get_object_terms( $post->ID, 'types' ); foreach( $terms as $term ) $term_names[] = $term->slug; echo implode( ' ', $term_names ); ?>">
					<figure>
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
		</section><!-- // grid-wrap -->
		
		<!-- Reset Loop -->
		<?php rewind_posts(); ?>
		
		<section class="slideshow">
			<ul>
		
			<!-- Loop them again for the slideshow, whoop whoop -->
			<?php if ( $work_query->have_posts() ) : while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
		
				<li id="itemDesc-<?php the_id(); ?>">
					<figure>
						<figcaption>
							<h3><?php the_title(); ?></h3>
							<p><?php the_content(); ?></p>
						</figcaption>
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
			<nav>
				<span class="icon nav-prev"></span>
				<span class="icon nav-next"></span>
				<span class="icon nav-close"></span>
			</nav>
			<div class="info-keys icon">Navigate with arrow keys</div>
		</section><!-- // slideshow -->
	</div><!-- grid-gallery -->
	</div><!-- work -->


<?php get_footer(); ?>