<?php
// Deprecated in 3.5.0. Gave a new page with default values for the editor.
list( $result, $notice ) = guide_deprecated( 'get_default_page_to_edit' );
return array( $result->post_type, $result->post_status, $notice );
