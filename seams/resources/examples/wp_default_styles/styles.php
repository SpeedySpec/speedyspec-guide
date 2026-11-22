<?php
// Registers WordPress's default styles: the admin styles, colors, buttons, dashicons, editor styles and the block library, with RTL versions.
$st = wp_styles();
return array( $st->default_dirs, isset( $st->registered['dashicons'] ), $st->registered['wp-admin']->deps );
