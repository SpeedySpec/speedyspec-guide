<?php
// Whether to buffer the page for wp_template_enhancement_output_buffer: when that filter or the wp_finalized_template_enhancement_output_buffer action has a callback, so pages stream otherwise; filtered by wp_should_output_buffer_template_for_enhancement, which classic themes turn on at priority 0 to load block styles on demand.
$classic = wp_should_output_buffer_template_for_enhancement();
remove_filter( 'wp_should_output_buffer_template_for_enhancement', '__return_true', 0 );
remove_all_filters( 'wp_template_enhancement_output_buffer' );
remove_all_actions( 'wp_finalized_template_enhancement_output_buffer' );
return array( $classic, wp_should_output_buffer_template_for_enhancement() );
