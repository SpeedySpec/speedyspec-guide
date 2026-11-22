<?php
// It builds its settings from emoji_url, emoji_ext, emoji_svg_url and emoji_svg_ext before printing; the last filter here stops it to show them.
class Guide_Emoji_Settings_Recorder {
	public $seen = array();

	public function record( $value ) {
		$this->seen[] = current_filter() . "=$value";
		return $value;
	}

	public function stop( $value ) {
		throw new RuntimeException( implode( ' ', $this->seen ) . " emoji_svg_ext=$value" );
	}
}
$recorder = new Guide_Emoji_Settings_Recorder();
foreach ( array( 'emoji_url', 'emoji_ext', 'emoji_svg_url' ) as $hook ) {
	add_filter( $hook, array( $recorder, 'record' ) );
}
add_filter( 'emoji_svg_ext', array( $recorder, 'stop' ) );
_print_emoji_detection_script();
