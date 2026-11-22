<?php
// Prints the table rows of a settings section's fields.
function guide_tea_field(): void
{
	echo '<input name="tea_blend">';
}
add_settings_field( 'tea_blend', 'Blend', 'guide_tea_field', 'tea_page', 'tea_section' );
return guide_render( fn() => do_settings_fields( 'tea_page', 'tea_section' ) );
