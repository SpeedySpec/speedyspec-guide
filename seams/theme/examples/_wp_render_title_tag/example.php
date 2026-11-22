<?php
// Hooked to wp_head: prints the title tag when the theme supports title-tag, which it must add before wp_loaded.
$id = wp_insert_post( array( 'post_title' => 'Hello World', 'post_status' => 'publish', 'post_date' => '2026-03-15 10:05:06', 'post_modified' => '2026-04-01 08:00:00' ) );
guide_go( "/?p=$id" );
the_post();
$refused = add_theme_support( 'title-tag' );
// Themes add support on after_setup_theme; that has passed here, so the feature is set directly.
$GLOBALS['_wp_theme_features']['title-tag'] = true;
return array( $refused, guide_render( '_wp_render_title_tag' ) );
