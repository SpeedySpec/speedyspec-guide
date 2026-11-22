<?php
// The other hosts enqueued scripts and styles load from, for resource hints.
wp_enqueue_script( 'cdn-lib', 'https://cdn.example.test/lib.js' );
wp_enqueue_style( 'local', '/wp-content/a.css' );
return wp_dependencies_unique_hosts();
