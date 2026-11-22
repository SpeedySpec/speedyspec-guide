<?php
// Both themes' functions.php files load, the child's first, so a parent can let a child replace what it defines.
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

guide_make_child_theme( array( 'functions.php' => '<?php // The child theme\'s functions.php.' ) );
// wp-settings.php includes each of these themes' functions.php, in this order.
return array_map( 'guide_short_path', array_map( 'trailingslashit', wp_get_active_and_valid_themes() ) );
