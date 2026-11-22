<?php
// Enqueues the media modal's scripts, styles, templates and settings, once per page.
wp_enqueue_media();
return array( wp_script_is( 'media-editor', 'enqueued' ), wp_script_is( 'media-audiovideo', 'enqueued' ), did_action( 'wp_enqueue_media' ) );
