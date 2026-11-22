<?php
// value_field picks the field for the value; a page without a title shows its ID.
$page = guide_page( 4, '' );
return ( new Walker_PageDropdown() )->walk( array( $page ), 0, array( 'selected' => 0, 'value_field' => 'post_name' ) );
