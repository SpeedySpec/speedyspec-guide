<?php
// get_template_part() tries {slug}-{name}.php then {slug}.php, in the child theme then the parent, passing it $args.
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
guide_make_child_theme(
	array(
		'template-parts/card.php' => '<?php echo esc_html( "Child card, size " . $args[\'size\'] );',
	)
);

ob_start();
$found = get_template_part( 'template-parts/card', 'book', array( 'size' => 'large' ) ); // No card-book.php: card.php.
$printed = ob_get_clean();
return array( 'printed' => $printed, 'missing part' => get_template_part( 'template-parts/nothing' ) );
