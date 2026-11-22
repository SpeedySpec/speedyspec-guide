<?php
// Sets a field of a network user, such as spam, firing make_spam_user or make_ham_user; deprecated in 5.3.0 for wp_update_user().
function guide_report_deprecated( $function_name, $replacement, $version ) {
	echo "$function_name is deprecated since $version" . ( $replacement ? " for $replacement" : '' ) . "\n";
}
add_action( 'deprecated_function_run', 'guide_report_deprecated', 10, 3 );
$grace = wpmu_create_user( 'grace', 'secret', 'grace@example.org' );
function guide_print_make_spam_user( $id ) {
	echo "make_spam_user\n";
}
add_action( 'make_spam_user', 'guide_print_make_spam_user' );
update_user_status( $grace, 'spam', 1 );
return get_userdata( $grace )->spam;
