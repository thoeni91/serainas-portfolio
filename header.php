<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="author" content="Marc Thoeni">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">


<!-- jQuery -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery-2.1.1.min.js"></script>

<!-- Google Grid Gallery -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/component.css" />
<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>

<!-- jQuery isotope -->
<script src="<?php bloginfo('template_url'); ?>/js/isotope.pkgd.min.js"></script>

<!-- Functions -->
<script src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>

<title><?php wp_title(); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
	<div id="headerContent">
		<?php wp_nav_menu( array ( 'container' => 'nav') ); ?>
	</div>
	<div id="headerImage" style="background-image:url(<?php echo get_header_image(); ?>)"></div>
</header>