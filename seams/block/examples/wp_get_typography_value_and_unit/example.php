<?php
// A CSS size split into its number and unit (px, em or rem), converted to a unit when asked; null for others.
return array( wp_get_typography_value_and_unit( '24px' ), wp_get_typography_value_and_unit( '1.5em', array( 'coerce_to' => 'px' ) ), wp_get_typography_value_and_unit( '5vw' ) );
