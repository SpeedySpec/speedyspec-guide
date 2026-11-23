<?php
// Prints the profile screen's Use https checkbox, for users on sites that allow choosing.
return str_contains( guide_render( fn() => use_ssl_preference( wp_get_current_user() ) ), 'use_ssl' );
