<?php
// Loads a template part, {slug}-{name}.php then {slug}.php, from the child then parent theme, passing it arguments; fires get_template_part_{$slug} and get_template_part. False when none exists.
return array( get_template_part( 'parts/card', 'post', array( 'size' => 'big' ) ), did_action( 'get_template_part_parts/card' ) );
