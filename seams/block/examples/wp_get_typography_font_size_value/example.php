<?php
// A font size preset's value for CSS, made fluid (a clamp()) when the theme turns on fluid typography in its settings; here it is off.
return array( wp_get_typography_font_size_value( array( 'size' => '2rem' ) ), wp_get_typography_font_size_value( array( 'size' => '2rem' ), array( 'fluid' => true ) ) );
