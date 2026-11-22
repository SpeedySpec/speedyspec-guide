<?php
// Prints the plugin installer's list table of plugins from the API, prepared by the global $wp_list_table.
$GLOBALS['wp_list_table'] = new class() {
	public function display(): void
	{
		echo '<table class="plugins">…</table>';
	}
};
$GLOBALS['tab'] = 'search';
return guide_render( 'display_plugins_table' );
