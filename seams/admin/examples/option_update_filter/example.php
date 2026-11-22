<?php
// Hooked to allowed_options: adds the options registered with register_setting() to their groups.
register_setting( 'tea', 'tea_blend' );
return option_update_filter( array() );
