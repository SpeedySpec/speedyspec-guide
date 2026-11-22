<?php
// The path of an attachment page's template: {mime type}-{subtype}.php, {subtype}.php, {type}.php, attachment.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
$att = wp_insert_attachment( array( 'post_title' => 'Pic', 'post_mime_type' => 'image/jpeg' ) );
guide_go( "/?attachment_id=$att" );
return str_replace( get_theme_root(), '<themes>', get_attachment_template() );
