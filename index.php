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
		
				<li id="singleItem-<?php the_id(); ?>">
				
				
					<figure>
						<div class="left">
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


<?php get_footer(); ?>