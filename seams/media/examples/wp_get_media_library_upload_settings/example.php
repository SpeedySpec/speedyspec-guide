<?php
// The settings the browser uses to process uploads itself: size limit, allowed types, image sizes, big-image threshold and metadata choices.
$settings = wp_get_media_library_upload_settings();
return array( array_keys( $settings ), $settings['bigImageSizeThreshold'] );
