<?php
// Whether a comment is too soon after the last one (15 seconds by default, comment_flood_filter).
return array( wp_throttle_comment_flood( false, time() - 5, time() ), wp_throttle_comment_flood( false, time() - 60, time() ) );
