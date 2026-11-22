<?php
// The starter content a theme registered (widgets, posts, attachments, options, theme mods, nav menus), expanded from core's predefined items; filtered by get_theme_starter_content.
$GLOBALS['_wp_theme_features']['starter-content'] = array( array( 'posts' => array( 'about', 'contact' ), 'options' => array( 'blogdescription' => 'Hello' ) ) );
$content = get_theme_starter_content();
return array( array_keys( $content['posts'] ), $content['posts']['about']['post_type'], $content['options'] );
