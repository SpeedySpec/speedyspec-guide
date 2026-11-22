<?php
// theme.json is merged in layers, each over the last: WordPress's defaults, the parent theme, the child, then the user.
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
		'version' => 3,
		'styles'  => array( 'color' => array( 'text' => '#222222' ) ),
	)
);
$theme_only = WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data()['styles']['color'];

// What the Site Editor saves when the site's owner picks a background in Styles.
$user_post = WP_Theme_JSON_Resolver::get_user_global_styles_post_id();
wp_update_post(
	array(
		'ID'           => $user_post,
		'post_content' => wp_json_encode(
			array(
				'version'                     => 3,
				'isGlobalStylesUserThemeJSON' => true,
				'styles'                      => array( 'color' => array( 'background' => '#000000' ) ),
			)
		),
	)
);
WP_Theme_JSON_Resolver::clean_cached_data();
$with_user = WP_Theme_JSON_Resolver::get_merged_data()->get_raw_data()['styles']['color'];

return array(
	'parent background'        => WP_Theme_JSON_Resolver::get_theme_data()->get_raw_data()['styles']['color']['background'] ?? null,
	'child and parent'         => $theme_only,
	'after the user saves'     => $with_user,
);
