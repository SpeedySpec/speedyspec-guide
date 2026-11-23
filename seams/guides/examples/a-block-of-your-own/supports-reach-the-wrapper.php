<?php
// Supports a block declares turn into classes and styles on its wrapper, through get_block_wrapper_attributes().
function my_plugin_render_book_card( $attributes, $content ) {
	return sprintf( '<div %s>%s</div>', get_block_wrapper_attributes( array( 'class' => 'my-plugin-book-card' ) ), wp_kses_post( $content ) );
}

register_block_type(
	'my-plugin/book-card',
	array(
		'supports'        => array(
			'color'      => array( 'background' => true, 'text' => true ),
			'typography' => array( 'fontSize' => true ),
		),
		'render_callback' => 'my_plugin_render_book_card',
	)
);

$html = do_blocks( '<!-- wp:my-plugin/book-card {"backgroundColor":"accent","style":{"color":{"text":"#222222"}},"fontSize":"large"} --><p>Dune</p><!-- /wp:my-plugin/book-card -->' );
unregister_block_type( 'my-plugin/book-card' );
return $html;
