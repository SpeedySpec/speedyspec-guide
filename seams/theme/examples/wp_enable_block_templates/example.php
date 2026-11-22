<?php
// Hooked to setup_theme: adds block-templates support for block themes.
switch_theme( 'twentytwentyfive' );
wp_enable_block_templates();
return current_theme_supports( 'block-templates' );
