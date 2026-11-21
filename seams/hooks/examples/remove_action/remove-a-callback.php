<?php
// Remove an action callback; keep the closure to remove it.
$callback = function () {
	echo 'ran';
};
add_action( 'guide_act', $callback );
remove_action( 'guide_act', $callback );
do_action( 'guide_act' );

return did_action( 'guide_act' );
