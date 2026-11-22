<?php
// Slugs are sanitized as saved slugs are; one that sanitizes to nothing is dropped. (WordPress hooks sanitize_title_with_dashes() to sanitize_title by default.)
add_filter( 'sanitize_title', 'sanitize_title_with_dashes', 10, 3 );
guide_core_abilities();
$content = new WP_Abilities_Content();
return array( guide_private( $content, 'normalize_slugs', array( 'slugs' => 'Hello-World, hello-world, !!!' ) ), guide_private( $content, 'normalize_slugs', array( 'slugs' => 2024 ) ), guide_private( $content, 'parse_list_input', array( 'k' => new stdClass() ), 'k' ) );
