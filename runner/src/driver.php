/**
 * Runs one example file in its own function scope and reports, as JSON, what it printed, what it returned
 * (`var_export`) and what it threw.
 */
function speedyspec_guide_example( string $file ): string {
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
	$output = ob_get_clean();
	return json_encode(
		array(
			'output' => false === $output ? '' : $output,
			'return' => $return,
			'error'  => $error,
		),
		JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE | JSON_THROW_ON_ERROR
	);
}
