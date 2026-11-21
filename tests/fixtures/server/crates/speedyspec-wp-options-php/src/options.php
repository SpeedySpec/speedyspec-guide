// Fixture facade: a port declaring WordPress's update_option() over its native function. Like the real facades, it has no
// opening tag: the runtime evals it.
function update_option( $option, $value ) {
	return \SpeedySpec\WpOptions\Native\update_option( $option, $value );
}
