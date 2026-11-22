<?php
// A plugin can supply a template for its own content through template_include, letting the theme's own file win.
// Builds a child theme of Twenty Twenty-One in a folder of its own, and makes it the active theme.
function guide_make_child_theme( array $files ) {
	$root = sys_get_temp_dir() . '/guide-theme-root';
	$dir  = $root . '/my-child';
	if ( is_dir( $dir ) ) {
		foreach ( new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir, FilesystemIterator::SKIP_DOTS ), RecursiveIteratorIterator::CHILD_FIRST ) as $item ) {
			$item->isDir() ? rmdir( $item->getPathname() ) : unlink( $item->getPathname() );
		}
	}
	$files['style.css'] = "/*\nTheme Name: My Child\nTemplate: twentytwentyone\n*/\n";
	foreach ( $files as $name => $contents ) {
		wp_mkdir_p( dirname( "$dir/$name" ) );
		file_put_contents( "$dir/$name", $contents );
	}
	register_theme_directory( $root );
	search_theme_directories( true );
	switch_theme( 'my-child' );
	return $root;
}
// Shortens a path to the theme it is in, so the result reads the same on any machine.
function guide_short_path( $path ) {
	return preg_replace( '#^.*/(my-child|twentytwentyone)/#', '$1/', $path );
}
// Runs the main query for an address, as a front-end request does.
function guide_visit( $url ) {
	$parts = wp_parse_url( $url );
	$_SERVER['REQUEST_URI'] = ( $parts['path'] ?? '/' ) . ( isset( $parts['query'] ) ? '?' . $parts['query'] : '' );
	$_GET = array();
	parse_str( $parts['query'] ?? '', $_GET );
	$GLOBALS['wp']->main();
}

function my_plugin_register_book_type() {
	register_post_type( 'my_book', array( 'label' => __( 'Books', 'my-plugin' ), 'public' => true ) );
}
my_plugin_register_book_type();

function my_plugin_book_template( $template ) {
	if ( is_singular( 'my_book' ) && '' === locate_template( 'single-my_book.php' ) ) {
		return WP_PLUGIN_DIR . '/my-plugin/templates/single-my_book.php'; // The plugin's own copy.
	}
	return $template;
}
add_filter( 'template_include', 'my_plugin_book_template' );

guide_make_child_theme( array() );
$book = wp_insert_post( array( 'post_type' => 'my_book', 'post_title' => 'Dune', 'post_status' => 'publish' ) );
guide_visit( "/?my_book=dune" );
$without_theme_copy = apply_filters( 'template_include', get_single_template() );

guide_make_child_theme( array( 'single-my_book.php' => '<?php // The theme\'s own template for books.' ) );
guide_visit( "/?my_book=dune" );
return array(
	'theme has none'  => str_replace( WP_PLUGIN_DIR, '<plugins>', $without_theme_copy ),
	'theme has one'   => guide_short_path( apply_filters( 'template_include', get_single_template() ) ),
);
