<?php
// Hooked to render_block_data: strips the old var:preset prefixes from a Navigation block's font style, weight, text decoration and transform, and turns strikethrough into line-through.
$block = parse_blocks( '<!-- wp:navigation {"style":{"typography":{"fontWeight":"var:preset|font-weight|700","textDecoration":"strikethrough"}}} /-->' )[0];
$block = block_core_navigation_typographic_presets_backcompatibility( $block );
return $block['attrs']['style']['typography'];
