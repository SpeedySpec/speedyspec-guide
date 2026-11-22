<?php
// The buffer's callback: passes complete HTML output through wp_template_enhancement_output_buffer, anything else unchanged.
add_filter( 'wp_template_enhancement_output_buffer', 'guide_mark_html' );
function guide_mark_html( $html ) {
	return str_replace( '</body>', '<!-- enhanced --></body>', $html );
}
return array( wp_finalize_template_enhancement_output_buffer( '<!DOCTYPE html><html><body>Hi</body></html>', PHP_OUTPUT_HANDLER_FINAL ), wp_finalize_template_enhancement_output_buffer( '{"json":1}', PHP_OUTPUT_HANDLER_FINAL ) );
