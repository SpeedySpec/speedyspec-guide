<?php
// Prints the theme install list table held in the global $wp_list_table.
$GLOBALS['wp_list_table'] = new class() {
	public function prepare_items(): void
	{
	}

	public function display(): void
	{
		echo '<div class="themes">…</div>';
	}
};
return guide_render( 'display_themes' );
