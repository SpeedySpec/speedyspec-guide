<?php
// The output shape, and the errors for a page past the end and a bad filter.
guide_core_abilities();
$content = new WP_Abilities_Content();
$page = guide_private( $content, 'invalid_page_number_error' );
$filter = guide_private( $content, 'invalid_filter_error', 'where[ids]', 'Bad.' );
return array( guide_private( $content, 'prepare_output', array( array( 'id' => 1 ) ), 1, 1 ), $page->get_error_code(), $page->get_error_data(), $filter->get_error_code(), $filter->get_error_data() );
