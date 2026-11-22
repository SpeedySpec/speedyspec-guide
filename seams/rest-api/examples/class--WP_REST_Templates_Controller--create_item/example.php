<?php
// The templates controller serves block templates at /wp/v2/templates and template parts at /wp/v2/template-parts, by ID theme//slug: the theme's files merged with the user's saved wp_template posts, created, updated, reverted and deleted by users who can edit theme options.
[ $status, $template ] = guide_rest( 'POST', '/wp/v2/templates', array( 'slug' => 'my-landing', 'title' => 'Landing', 'content' => '<!-- wp:paragraph --><p>Welcome</p><!-- /wp:paragraph -->' ) );
$list = array_column( guide_rest( 'GET', '/wp/v2/templates' )[1], 'id' );
wp_set_current_user( 0 );
return array( $status, $template['id'], $template['source'], $template['type'], in_array( $template['id'], $list, true ), guide_rest( 'GET', '/wp/v2/templates' )[0] );
