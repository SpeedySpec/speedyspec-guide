<?php
// What esc_url_raw() calls: esc_url() in the db context.
return array( sanitize_url( 'example.com/?a=1&b=2' ), sanitize_url( 'data:text/html,hi' ) );
