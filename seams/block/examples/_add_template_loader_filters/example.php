<?php
// Hooked to wp_loaded: when the site editor asks which template a new post would use (_wp-find-template) on a theme with block templates, hooks _resolve_template_for_new_post into pre_get_posts.
$_GET['_wp-find-template'] = 1;
$GLOBALS['_wp_theme_features']['block-templates'] = true;
_add_template_loader_filters();
return has_action( 'pre_get_posts', '_resolve_template_for_new_post' );
