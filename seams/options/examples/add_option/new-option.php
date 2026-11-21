<?php
// add_option() stores a new option, and get_option() reads it back.
add_option( 'guide_color', 'blue' );
return get_option( 'guide_color' );
