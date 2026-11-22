<?php
// Prints every section of a settings page, each with its title, intro and fields table.
function guide_tea_section(): void
{
	echo '<p>Choose your tea.</p>';
}
function guide_tea_field(): void
{
	echo '<input name="tea_blend">';
}
add_settings_section( 'tea_section', 'Tea', 'guide_tea_section', 'tea_page' );
add_settings_field( 'tea_blend', 'Blend', 'guide_tea_field', 'tea_page', 'tea_section' );
return guide_render( fn() => do_settings_sections( 'tea_page' ) );
