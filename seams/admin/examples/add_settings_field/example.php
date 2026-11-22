<?php
// Adds a field to a settings page section, with a callback that prints its input.
function guide_tea_field(): void
{
	echo '<input name="tea_blend">';
}
add_settings_field( 'tea_blend', 'Blend', 'guide_tea_field', 'reading', 'default', array( 'label_for' => 'tea_blend' ) );
return $GLOBALS['wp_settings_fields']['reading']['default']['tea_blend']['args'];
