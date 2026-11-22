<?php
// A Page N breadcrumb item for paged views, or Comments Page N for comment pages.
set_query_var( 'paged', 3 );
set_query_var( 'cpage', 2 );
return array( block_core_breadcrumbs_create_page_number_item(), block_core_breadcrumbs_create_page_number_item( 'cpage' ) );
