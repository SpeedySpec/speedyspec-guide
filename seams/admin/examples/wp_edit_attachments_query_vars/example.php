<?php
// The query variables of the media library list from the request: type, month, order and per page.
return array_intersect_key( wp_edit_attachments_query_vars( array( 'post_mime_type' => 'image', 'orderby' => 'date' ) ), array_flip( array( 'post_type', 'post_mime_type', 'post_status' ) ) );
