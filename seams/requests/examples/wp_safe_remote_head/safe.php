<?php
// wp_safe_remote_head() is a HEAD with reject_unsafe_urls on.
return wp_safe_remote_head( 'http://[::1]/' )->get_error_code();
