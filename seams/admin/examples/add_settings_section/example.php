<?php
// Adds a section to a settings page, with a title and a callback that prints its intro.
function guide_tea_section(): void
{
	echo '<p>Choose your tea.</p>';
}
add_settings_section( 'tea_section', 'Tea', 'guide_tea_section', 'reading' );
return array_keys( $GLOBALS['wp_settings_sections']['reading'] );
