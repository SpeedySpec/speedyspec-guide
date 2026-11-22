<?php
// Settings decide what the editor offers: here no custom colors anywhere, and no text color for paragraphs.
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
			'color'  => array( 'custom' => false ),
			'blocks' => array( 'core/paragraph' => array( 'color' => array( 'text' => false ) ) ),
		),
	)
);
return array(
	'custom colors'             => wp_get_global_settings( array( 'color', 'custom' ) ),
	'text color, any block'     => wp_get_global_settings( array( 'color', 'text' ) ),
	'text color, in paragraphs' => wp_get_global_settings( array( 'color', 'text' ), array( 'block_name' => 'core/paragraph' ) ),
);
