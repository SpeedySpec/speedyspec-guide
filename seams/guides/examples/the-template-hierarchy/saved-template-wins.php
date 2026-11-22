<?php
// In a block theme, a template the site's owner saved in the Site Editor is used instead of the theme's file.
switch_theme( 'twentytwentyfive' );
$before = get_block_template( 'twentytwentyfive//single' );

// What the Site Editor stores when someone edits the Single template.
wp_insert_post(
	array(
		'post_type'    => 'wp_template',
		'post_name'    => 'single',
		'post_title'   => 'Single',
		'post_status'  => 'publish',
		'post_content' => '<!-- wp:paragraph --><p>Edited in the Site Editor.</p><!-- /wp:paragraph -->',
		'tax_input'    => array( 'wp_theme' => array( 'twentytwentyfive' ) ),
	)
);
$after = get_block_template( 'twentytwentyfive//single' );
return array(
	'before' => $before->source,
	'after'  => $after->source,
	'reset'  => get_block_file_template( 'twentytwentyfive//single' )->source,
);
