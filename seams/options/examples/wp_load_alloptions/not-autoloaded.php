<?php
// An option added with autoload off is not in the set.
add_option( 'guide_large', 'value', '', false );
return array_key_exists( 'guide_large', wp_load_alloptions() );
