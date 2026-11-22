<?php
// Hooked to enqueue_block_editor_assets: passes the editor the dynamic blocks marked autoRegister in their supports, as window.__unstableAutoRegisterBlocks, to register them with server-side rendering.
register_block_type( 'guide/auto', array( 'supports' => array( 'autoRegister' => true ), 'render_callback' => '__return_empty_string' ) );
_wp_enqueue_auto_register_blocks();
return wp_json_encode( wp_scripts()->get_data( 'wp-block-library', 'before' ) );
