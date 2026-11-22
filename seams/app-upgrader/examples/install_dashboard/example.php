<?php
// Prints the plugin installer's Featured tab: its list table, then the most popular plugin tags as a cloud of links.
$GLOBALS['wp_list_table'] = new class() {
	public function display(): void
	{
		echo '<table class="plugins">…</table>';
	}
};
guide_queue_http( array( array( 'widget' => array( 'name' => 'widget', 'slug' => 'widget', 'count' => 5000 ) ) ) );
$html = guide_render( 'install_dashboard' );
return array( str_contains( $html, 'Popular tags' ), str_contains( $html, '>widget<' ), str_contains( $html, '<table class="plugins">' ) );
