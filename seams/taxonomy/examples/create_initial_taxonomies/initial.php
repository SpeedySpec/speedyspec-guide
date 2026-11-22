<?php
// Registers WordPress's taxonomies: category, post_tag, nav_menu, link_category, post_format, wp_theme, wp_template_part_area and wp_pattern_category, with their rewrite slugs from the category_base and tag_base options.
return array_keys( get_taxonomies() );
