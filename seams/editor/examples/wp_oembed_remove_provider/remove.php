<?php
// Removes a provider by its pattern; true once removed, false when it wasn't there (or before plugins_loaded, when the removal is queued).
do_action( 'plugins_loaded' );
return array( wp_oembed_remove_provider( '#https?://((m|www)\.)?youtube\.com/watch.*#i' ), wp_oembed_remove_provider( 'nope' ), _wp_oembed_get_object()->get_provider( 'https://www.youtube.com/watch?v=abc', array( 'discover' => false ) ) );
