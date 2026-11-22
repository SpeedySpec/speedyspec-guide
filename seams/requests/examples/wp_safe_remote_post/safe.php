<?php
// wp_safe_remote_post() is a POST with reject_unsafe_urls on.
return wp_safe_remote_post( 'http://192.168.1.1/' )->get_error_code();
