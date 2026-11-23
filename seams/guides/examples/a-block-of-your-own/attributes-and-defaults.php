<?php
// Attributes the markup leaves out take their defaults, and values of the wrong type are dropped before rendering.
function my_plugin_render_book_card( $attributes ) {
	return sprintf(
		'<p %s>%s: %s</p>',
		get_block_wrapper_attributes(),
		esc_html( $attributes['title'] ),
		esc_html( (string) $attributes['rating'] )
	);
}

register_block_type(
	'my-plugin/book-card',
	array(
		'attributes'      => array(
			'title'  => array( 'type' => 'string', 'default' => 'Untitled' ),
			'rating' => array( 'type' => 'integer', 'default' => 3 ),
		),
		'render_callback' => 'my_plugin_render_book_card',
	)
);

$result = array(
	'all given'     => do_blocks( '<!-- wp:my-plugin/book-card {"title":"Emma","rating":4} /-->' ),
	'none given'    => do_blocks( '<!-- wp:my-plugin/book-card /-->' ),
	'wrong type'    => do_blocks( '<!-- wp:my-plugin/book-card {"title":"Ivanhoe","rating":"five"} /-->' ),
	'markup escaped' => do_blocks( '<!-- wp:my-plugin/book-card {"title":"<script>x</script>"} /-->' ),
);
unregister_block_type( 'my-plugin/book-card' );
return $result;
