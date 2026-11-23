<?php
// Prints the categories as nested checkboxes, as wp_terms_checklist() does for categories.
wp_insert_term( 'Green', 'category' );
return substr_count( guide_render( fn() => wp_category_checklist() ), 'type="checkbox"' );
