<?php
// The warning shown to admins when a block template is empty.
return str_contains( wp_render_empty_block_template_warning( (object) array( 'title' => 'Index', 'slug' => 'index' ) ), 'Index' );
