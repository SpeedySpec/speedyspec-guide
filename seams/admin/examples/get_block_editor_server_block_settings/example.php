<?php
// The settings of the server-registered block types the block editor needs: attributes, supports, styles and the rest, by name.
$settings = get_block_editor_server_block_settings();
return array( isset( $settings['core/paragraph'] ), array_key_exists( 'attributes', $settings['core/latest-posts'] ) );
