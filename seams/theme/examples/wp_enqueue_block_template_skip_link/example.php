<?php
// Hooked to wp_enqueue_scripts: enqueues the skip-to-content link style when the theme supports block templates and the page is rendered from one.
$GLOBALS['_wp_theme_features']['block-templates'] = true;
$GLOBALS['_wp_current_template_content'] = '<!-- wp:group {"tagName":"main"} --><main class="wp-block-group"></main><!-- /wp:group -->';
wp_enqueue_block_template_skip_link();
return wp_style_is( 'wp-block-template-skip-link' );
