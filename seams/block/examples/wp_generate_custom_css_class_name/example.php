<?php
// Makes a block's unique custom CSS class name (wp-custom-css-...) and registers its stylesheet; '' without custom CSS.
$block = parse_blocks( '<!-- wp:paragraph {"style":{"css":"color: red;"}} --><p class="wp-block-paragraph">Hi</p><!-- /wp:paragraph -->' )[0];
return (bool) preg_match( '/^wp-custom-css-[0-9a-f]+$/', wp_generate_custom_css_class_name( $block ) );
