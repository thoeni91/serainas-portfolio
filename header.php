<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="author" content="Marc Thoeni">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.css">
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico">
<!--[if lte IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/ie.css">
<![endif]-->

<!-- jQuery -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery-1.11.1.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/js/jquery-migrate-1.2.1.min.js"></script>
    
<script type="text/javascript">
    var template_url = "<?php bloginfo('template_url'); ?>";
</script>

<!-- Google Grid Gallery -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/css/component.css" />
<script src="<?php bloginfo('template_url'); ?>/js/modernizr.custom.js"></script>

<!-- jQuery isotope -->
<script src="<?php bloginfo('template_url'); ?>/js/isotope.pkgd.min.js"></script>

<!-- animateauto js -->
<script src="<?php bloginfo('template_url'); ?>/js/animateauto.js"></script>

<!-- jquery waypoints -->
<script src="<?php bloginfo('template_url'); ?>/js/waypoints.min.js"></script>

<!-- skrollr -->
<script src="<?php bloginfo('template_url'); ?>/js/skrollr.js"></script>
    
<!-- skrollr -->
<script src="<?php bloginfo('template_url'); ?>/js/jquery.infinitescroll.min.js"></script>

<!-- Functions -->
<script src="<?php bloginfo('template_url'); ?>/js/functions.js"></script>

<title><?php wp_title(); ?></title>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> name="top">

<header>
	<div id="headerContent"
        data-110-top="top:90px;"
        data-anchor-target="#main-container">
        <a id="logo" href="#top" title="Seraina Cavigelli"><img src="<?php bloginfo("template_url"); ?>/images/serainacavigelli_weiss.svg" alt="Serainas Portfolio" /></a>
		<?php wp_nav_menu( array ( 'container' => 'nav') ); ?>
	</div>
    <div id="headerImage" style="background-image:url(<?php echo get_header_image(); ?>)"></div>
    <a id="arrow" href="#work"></a>
</header>