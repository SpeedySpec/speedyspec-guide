<?php
// The template types WordPress knows (index, home, front-page, single, page, archive and the rest) with titles and descriptions; filtered by default_template_types.
return array_slice( array_keys( get_default_block_template_types() ), 0, 8 );
