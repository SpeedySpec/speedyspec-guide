<?php
// The path of an embed's template: embed-{post_type}-{format}.php, embed-{post_type}.php, embed.php.
switch_theme( 'twentytwentyone' );
wp_set_template_globals();
return str_replace( ABSPATH, '<wordpress>/', get_embed_template() );
