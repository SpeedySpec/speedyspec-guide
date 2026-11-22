<?php
// Registers the theme's block styles, such as Overlap for Columns, Borders and Frame for Image, and Dividers for Latest Posts; on init.
guide_theme( 'twentytwentyone' );
twenty_twenty_one_register_block_styles();
$styles = WP_Block_Styles_Registry::get_instance()->get_all_registered();
return array_map( 'array_keys', array_filter( $styles, fn( $s ) => (bool) array_filter( array_keys( $s ), fn( $n ) => str_starts_with( $n, 'twentytwentyone-' ) ) ) );
