<?php
// A block is described by its block.json; register_block_type() reads the folder, and the file names its render template.
// The example writes the block's folder to a temporary place; a plugin ships it as build/book-card/.
function guide_write_block_folder( $files ) {
	$dir = trailingslashit( get_temp_dir() ) . 'guide-book-card';
	wp_mkdir_p( $dir );
	foreach ( $files as $name => $contents ) {
		file_put_contents( $dir . '/' . $name, $contents );
	}
	return $dir;
}
function guide_remove_block_folder( $dir ) {
	array_map( 'unlink', glob( $dir . '/*' ) );
	rmdir( $dir );
}

$dir = guide_write_block_folder(
	array(
		'block.json' => wp_json_encode(
			array(
				'$schema'     => 'https://schemas.wp.org/trunk/block.json',
				'apiVersion'  => 3,
				'name'        => 'my-plugin/book-card',
				'title'       => 'Book card',
				'category'    => 'widgets',
				'textdomain'  => 'my-plugin',
				'attributes'  => array(
					'title'  => array( 'type' => 'string', 'default' => '' ),
					'rating' => array( 'type' => 'integer', 'default' => 3 ),
				),
				'supports'    => array( 'color' => array( 'background' => true ) ),
				'render'      => 'file:./render.php',
			)
		),
		// render.php runs for each block, with $attributes, $content and $block set.
		'render.php' => '<?php printf( \'<div %s><h3>%s</h3><p>%s</p></div>\', get_block_wrapper_attributes(), esc_html( $attributes[\'title\'] ), esc_html( str_repeat( \'★\', (int) $attributes[\'rating\'] ) ) );',
	)
);

function my_plugin_register_blocks( $dir ) {
	return register_block_type( $dir ); // In a plugin: register_block_type( __DIR__ . '/build/book-card' ) on init.
}
$type = my_plugin_register_blocks( $dir );

$html = do_blocks( '<!-- wp:my-plugin/book-card {"title":"Dune","rating":5} /-->' );
unregister_block_type( 'my-plugin/book-card' );
guide_remove_block_folder( $dir );
return array(
	'registered' => $type->name,
	'title'      => $type->title,
	'dynamic'    => $type->is_dynamic(),
	'rendered'   => trim( $html ),
);
