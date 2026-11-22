<?php
// Prints a page in an iframe, such as the old media dialog: the iframe's head, the content callback's output and the footer.
function guide_dialog_body(): void
{
	echo '<p>Hello from the dialog</p>';
}
$html = guide_render( fn() => wp_iframe( 'guide_dialog_body' ) );
return array( str_contains( $html, 'Hello from the dialog' ), str_contains( $html, '</html>' ) );
