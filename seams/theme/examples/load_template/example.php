<?php
// Includes a template file with the query globals in scope and arguments in $args, once or every time; fires wp_before_load_template and wp_after_load_template.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
$file = get_theme_root() . '/twentytwentyone/template-parts/footer/footer-widgets.php';
guide_render( fn() => load_template( $file, false, array( 'guide' => 1 ) ) );
return array( did_action( 'wp_before_load_template' ), did_action( 'wp_after_load_template' ) );
