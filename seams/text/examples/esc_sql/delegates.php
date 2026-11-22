<?php
// esc_sql() hands the value to $wpdb->_escape(); here $wpdb is a stand-in that shows what it gets.
$GLOBALS['wpdb'] = new class {
	public function _escape( $data ) {
		return array( 'escaped' => $data );
	}
};
return esc_sql( array( "it's" ) );
