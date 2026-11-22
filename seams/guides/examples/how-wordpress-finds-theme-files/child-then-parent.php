<?php
// A child theme's file wins; any file it doesn't have comes from the parent theme.
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

guide_make_child_theme( array( 'page.php' => '<?php // The child theme\'s page template.' ) );
return array(
	'stylesheet (child)' => get_stylesheet(),
	'template (parent)'  => get_template(),
	'page.php'           => guide_short_path( locate_template( 'page.php' ) ),
	'single.php'         => guide_short_path( locate_template( 'single.php' ) ),
	'missing.php'        => locate_template( 'missing.php' ),
	'theme file'         => guide_short_path( get_theme_file_path( 'assets/js/primary-navigation.js' ) ),
	'parent theme file'  => guide_short_path( get_parent_theme_file_path( 'page.php' ) ),
);
