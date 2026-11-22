<?php
// The output shape, and the errors for a page past the end and a bad filter.
guide_core_abilities();
$users = new WP_Abilities_Users();
$page = guide_private( $users, 'invalid_page_number_error' );
$filter = guide_private( $users, 'invalid_filter_error', 'where[ids]', 'Bad.' );
return array( guide_private( $users, 'prepare_output', array(), 0, 0 ), $page->get_error_code(), $page->get_error_data(), $filter->get_error_code(), $filter->get_error_data() );
