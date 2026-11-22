<?php
// Enqueues the theme's block editor script, editor.js; on enqueue_block_editor_assets.
guide_theme( 'twentytwentyone' );
twentytwentyone_block_editor_script();
return array( wp_script_is( 'twentytwentyone-editor' ), wp_scripts()->registered['twentytwentyone-editor']->deps );
