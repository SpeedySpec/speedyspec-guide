<?php
// A CSS rule from a selector, property and value with a prefix and suffix, printed unless told not to; empty without a value or selector.
guide_theme( 'twentytwentyone' );
require_once get_template_directory() . '/inc/custom-css.php';
return array( twenty_twenty_one_generate_css( '.site', 'color', 'fff', '#', '', false ), twenty_twenty_one_generate_css( '.site', 'color', '', '', '', false ), guide_render( fn() => twenty_twenty_one_generate_css( 'a', 'margin', '2', '', 'px' ) ) );
