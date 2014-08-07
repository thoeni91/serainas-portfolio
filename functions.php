<?php

$headerOptions = array(
	'width'			=> 2000,
	'height'		=> 800,
	'header-text' 	=> false,
);

/* Theme Support Stuff */
add_theme_support( 'custom-header', $headerOptions );
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' ); 

/* Image Sizes */
add_image_size( 'work-small', 650 );
add_image_size( 'page-thumbnail', 1920, 1600, true );

/* Custom Post Type: Work */
add_action( 'init', 'work_init' );

function myplugin_settings() { 
// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');  
}
 // Add to the admin_init hook of your theme functions.php file 
add_action( 'admin_init', 'myplugin_settings' );


// Custom login logo
function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
        	width:300px;
        	height:50px;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/serainacavigelli_navy.svg);
            background-size: 300px 50px;
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// Custom post type --> Work
function work_init() {
	$labels = array(
		'name'               => _x( 'Work', 'post type general name' ),
		'singular_name'      => _x( 'Work', 'post type singular name' ),
		'menu_name'          => _x( 'Work', 'admin menu'),
		'name_admin_bar'     => _x( 'Work', 'add new on admin bar' ),
		'add_new'            => _x( 'Hinzufügen', 'book' ),
		'add_new_item'       => __( 'Neue Arbeit hinzufügen' ),
		'new_item'           => __( 'Neue Arbeit'),
		'edit_item'          => __( 'Work bearbeiten'),
		'view_item'          => __( 'Work ansehen' ),
		'all_items'          => __( 'Alle Arbeiten' ),
		'search_items'       => __( 'Arbeit suchen'),
		'parent_item_colon'  => __( 'Übergeordnete Arbeit:' ),
		'not_found'          => __( 'Keine Arbeit gefunden.'),
		'not_found_in_trash' => __( 'Keine Arbeit im Papierkorb.' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'menu_icon'			 => 'dashicons-heart',
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'work' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 15,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'capability_type' 	 => array('work', 'works'),
		'map_meta_cap'		 => true
	);

	register_post_type( 'work', $args );
}  

// Add meta box to 'work'
function workDetail_meta_box() {

	$screens = array( 'work' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'work-detail',
			__( 'Work Details', 'myplugin_textdomain' ),
			'workDetail_callback',
			$screen,
			'normal'
		);
	}
}
add_action( 'add_meta_boxes', 'workDetail_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function workDetail_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'workDetail_meta_box', 'workDetail_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$leistungen = get_post_meta( $post->ID, 'leistungen', true );
	$auftrag = get_post_meta( $post->ID, 'auftrag', true );
	$status = get_post_meta( $post->ID, 'status', true );
	
	?>
	<p>
		<label for="leistungen"><strong>Leistung</strong></label><br />
		<input type="text" name="leistungen" id="leistungen" value="<?php echo $leistungen; ?>"/>
	</p>
	
	<p>
		<label for="auftrag"><strong>Auftrag</strong></label><br />
		<input type="text" name="auftrag" id="auftrag" value="<?php echo $auftrag; ?>" />
	</p>
	
	<p>
		<label for="status"><strong>Status</strong></label><br />
		<input type="text" name="status" id="status" value="<?php echo $status; ?>" />
	</p>
	
	<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function workDetail_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['workDetail_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['workDetail_meta_box_nonce'], 'workDetail_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	// Make sure that it is set.
	if ( isset( $_POST['leistungen'] ) ) {
		update_post_meta( $post_id, 'leistungen', $_POST['leistungen'] );
	}
	
	if ( isset( $_POST['auftrag'] ) ) {
		update_post_meta( $post_id, 'auftrag', $_POST['auftrag'] );
	}
	
	if ( isset( $_POST['status'] ) ) {
		update_post_meta( $post_id, 'status', $_POST['status'] );
	}
	
}
add_action( 'save_post', 'workDetail_save_meta_box_data' );

// Register Custom Taxonomy
function add_types() {

	$labels = array(
		'name'                       => 'Types',
		'singular_name'              => 'Type',
		'menu_name'                  => 'Types',
		'all_items'                  => 'Alle Types',
		'parent_item'                => 'Übergeordnete Types',
		'parent_item_colon'          => '',
		'new_item_name'              => 'Type umbenennen',
		'add_new_item'               => 'Neuen Type hinzufügen',
		'edit_item'                  => 'Type bearbeiten',
		'update_item'                => 'Type aktualisieren',
		'separate_items_with_commas' => '',
		'search_items'               => 'Types suchen',
		'add_or_remove_items'        => 'Types hinzufügen oder entfernen',
		'choose_from_most_used'      => 'Wähle aus meistbenutzten Types',
		'not_found'                  => 'Nicht gefunden',
	);
	
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'capabilities' => array(
	      'manage_terms'=> 'edit_works',
	      'edit_terms'=> 'edit_works',
	      'delete_terms'=> 'edit_works',
	      'assign_terms' => 'edit_works'
	    ),
	);
	register_taxonomy( 'types', array( 'work' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'add_types', 0 );

// Adds multiple post thumbnails to pages
if (class_exists('MultiPostThumbnails')) {
    new MultiPostThumbnails(
        array(
            'label' => 'Bild unten',
            'id' => 'page-thumbnail-below',
            'post_type' => 'page'
        )
    );
}

?>