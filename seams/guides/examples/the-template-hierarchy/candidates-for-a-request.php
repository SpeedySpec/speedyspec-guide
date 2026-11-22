<?php
// For each request WordPress builds a list of candidate files, most specific first, and uses the first that exists.
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

function guide_record_page_candidates( $templates ) {
	$GLOBALS['guide_candidates'] = $templates;
	return $templates;
}
add_filter( 'page_template_hierarchy', 'guide_record_page_candidates' );

guide_make_child_theme( array( 'page-about.php' => '<?php // A template for the About page alone.' ) );
$about = wp_insert_post( array( 'post_title' => 'About', 'post_name' => 'about', 'post_type' => 'page', 'post_status' => 'publish' ) );
guide_visit( "/?page_id=$about" );
$chosen = get_page_template();
return array(
	'candidates' => array_map( 'guide_short_path', str_replace( (string) $about, "{id}", $GLOBALS['guide_candidates'] ) ),
	'chosen'     => guide_short_path( $chosen ),
);
