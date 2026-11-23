<?php
// Prints the link categories as checkboxes, the link's checked.
wp_insert_term( 'Friends', 'link_category' );
return str_contains( guide_render( fn() => wp_link_category_checklist() ), 'Friends' );
