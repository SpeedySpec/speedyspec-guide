<?php
// Whether posts of a type use the block editor: shown in REST and supporting the editor; filtered by use_block_editor_for_post_type.
register_post_type( 'old', array( 'show_in_rest' => false ) );
return array( use_block_editor_for_post_type( 'post' ), use_block_editor_for_post_type( 'old' ) );
