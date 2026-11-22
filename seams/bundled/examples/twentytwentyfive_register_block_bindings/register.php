<?php
// Registers the twentytwentyfive/format block bindings source, which gives the post format's name; on init.
guide_theme( 'twentytwentyfive' );
twentytwentyfive_register_block_bindings();
return get_block_bindings_source( 'twentytwentyfive/format' )->label;
