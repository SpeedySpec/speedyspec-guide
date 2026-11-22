<?php
// A preset in theme.json becomes a CSS custom property, and a style can point at it with var:preset|… .
// Builds a child of the Twenty Twenty-Five block theme with its own theme.json, and makes it the active theme.
function guide_make_block_child_theme( array $theme_json ) {
	$dir = sys_get_temp_dir() . '/guide-theme-root/my-block-child';
	array_map( 'unlink', glob( "$dir/*" ) ?: array() ); // Start from an empty theme folder.
	wp_mkdir_p( $dir );
	file_put_contents( "$dir/style.css", "/*\nTheme Name: My Block Child\nTemplate: twentytwentyfive\n*/\n" );
	file_put_contents( "$dir/theme.json", wp_json_encode( $theme_json ) );
	register_theme_directory( dirname( $dir ) );
	search_theme_directories( true );
	switch_theme( 'my-block-child' );
	WP_Theme_JSON_Resolver::clean_cached_data();
	wp_clean_theme_json_cache();
}

guide_make_block_child_theme(
	array(
		'version'  => 3,
		'settings' => array(
			'color' => array(
				'palette' => array(
					array( 'slug' => 'accent', 'name' => 'Accent', 'color' => '#c0392b' ),
				),
			),
		),
		'styles'   => array( 'elements' => array( 'link' => array( 'color' => array( 'text' => 'var:preset|color|accent' ) ) ) ),
	)
);
$variables = wp_get_global_stylesheet( array( 'variables' ) );
preg_match( '/--wp--preset--color--accent:\s*[^;]+/', $variables, $accent );
return array(
	'custom property' => $accent[0] ?? null,
	'link color'      => wp_get_global_styles( array( 'elements', 'link', 'color', 'text' ) ),
	'resolved'        => wp_get_global_styles( array( 'elements', 'link', 'color', 'text' ), array( 'transforms' => array( 'resolve-variables' ) ) ),
);
