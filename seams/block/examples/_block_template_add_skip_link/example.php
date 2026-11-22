<?php
// Adds a skip-to-content link before the template's wp-site-blocks div, pointing at its main element (given an id when it has none); the HTML unchanged when either is missing.
$html = _block_template_add_skip_link( '<div class="wp-site-blocks"><header>H</header><main>M</main></div>' );
return array( str_contains( $html, 'skip-link' ), str_contains( $html, '<main id="wp--skip-link--target"' ), _block_template_add_skip_link( '<p>none</p>' ) );
