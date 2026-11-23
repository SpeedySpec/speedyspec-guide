<?php
// Deprecated in 3.3.0; use wp_media_upload_handler(). Handled the old media dialog's video upload tab, now through wp_media_upload_handler().
list( $result, $notice ) = guide_deprecated( 'media_upload_video' );
return strtok( $notice, '<' );
