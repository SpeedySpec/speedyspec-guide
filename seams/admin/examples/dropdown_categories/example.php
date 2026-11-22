<?php
// Deprecated in 2.6.0; use wp_category_checklist(). Printed the post screen's category checkboxes, now with wp_category_checklist().
list( $result, $notice ) = guide_deprecated( 'dropdown_categories' );
return array( $result, str_contains( $notice, 'in-category-1' ) );
