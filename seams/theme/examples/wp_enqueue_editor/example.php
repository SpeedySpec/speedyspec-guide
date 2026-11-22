<?php
// Enqueues the classic editor's scripts and styles, to make one in JavaScript; fires wp_enqueue_editor.
wp_enqueue_editor();
return did_action( 'wp_enqueue_editor' );
