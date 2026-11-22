<?php
// Returning true brings back the legacy parser, which keeps a disallowed script's contents as text.
add_filter( 'wp_kses_force_legacy_parser', '__return_true', 20 );
return wp_kses( '<p>Hi <script>alert(1)</script></p>', array( 'p' => array() ) );
