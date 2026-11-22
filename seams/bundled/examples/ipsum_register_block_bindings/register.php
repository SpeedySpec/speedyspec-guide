<?php
// Registers the ipsum/comments-cta block bindings source, which uses the postId context; on init.
guide_theme( 'ipsum' );
ipsum_register_block_bindings();
$source = get_block_bindings_source( 'ipsum/comments-cta' );
return array( $source->label, $source->uses_context );
