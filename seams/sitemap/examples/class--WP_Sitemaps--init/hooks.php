<?php
// It registers the rewrite rules and hooks rendering on template_redirect; with sitemaps on, it registers the providers and adds the index to robots.txt.
$sitemaps = new WP_Sitemaps();
$sitemaps->init();
return array( array_keys( $GLOBALS['wp_rewrite']->extra_rules_top ), has_action( 'template_redirect', array( $sitemaps, 'render_sitemaps' ) ), has_filter( 'robots_txt', array( $sitemaps, 'add_robots' ) ) );
