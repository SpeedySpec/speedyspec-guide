<?php
// Removes a feature the theme supports, unhooking what it added; some features can't be removed this way.
add_theme_support( 'post-formats', array( 'aside' ) );
return array( remove_theme_support( 'post-formats' ), current_theme_supports( 'post-formats' ) );
