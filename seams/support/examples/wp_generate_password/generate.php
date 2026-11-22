<?php
// A random password of a length, from letters and digits, plus special characters and extra ones when asked; random_password filters it.
$p = wp_generate_password( 16, false );
return array( strlen( $p ), ctype_alnum( $p ), strlen( wp_generate_password() ) );
