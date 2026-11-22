<?php
// Whether the active theme is a child theme: the stylesheet and template folders WordPress loaded differ.
$parent = is_child_theme();
$GLOBALS['wp_stylesheet_path'] = get_theme_root() . '/kid';
$GLOBALS['wp_template_path'] = get_theme_root() . '/twentytwentyfive';
return array( $parent, is_child_theme() );
