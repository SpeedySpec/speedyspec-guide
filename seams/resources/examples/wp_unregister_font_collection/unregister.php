<?php
// Removes a font collection; false for an unknown one.
wp_register_font_collection( 'guide-fonts', array( 'name' => 'Guide fonts', 'font_families' => array() ) );
return array( wp_unregister_font_collection( 'guide-fonts' ), wp_unregister_font_collection( 'guide-fonts' ) );
