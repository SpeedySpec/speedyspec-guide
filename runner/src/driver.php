/**
 * Runs one example file in its own function scope and reports, as JSON, what it printed, what it returned
 * (`var_export`) and what it threw.
 */
function speedyspec_guide_example( string $file ): string {
	$GLOBALS['speedyspec_guide_level'] = ob_get_level();
	ob_start();
	$return = null;
	$error  = null;
	try {
		$value  = ( static function ( string $speedyspec_guide_file ) {
			return require $speedyspec_guide_file;
		} )( $file );
		$return = var_export( $value, true );
	} catch ( \Throwable $e ) {
		$error = get_class( $e ) . ': ' . $e->getMessage();
	}
	return json_encode(
		array(
			'output' => speedyspec_guide_output(),
			'return' => $return,
			'error'  => $error,
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR
	);
}

/**
 * Everything printed since the example started, including buffers the example opened and left open; closes them.
 * Also called by the runner after a fatal error, before the request ends.
 */
function speedyspec_guide_output(): string {
	$base   = $GLOBALS['speedyspec_guide_level'] ?? 0;
	$output = '';
	while ( ob_get_level() > $base ) {
		$output = (string) ob_get_clean() . $output;
	}
	return $output;
}
