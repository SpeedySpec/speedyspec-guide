<?php
// Hooked to wp_head for block templates: prints the title tag.
guide_go( '/' );
return guide_render( '_block_template_render_title_tag' );
