<?php
// Remove an action callback by the name it was added with.
function guide_say_ran() {
	echo 'ran';
}
add_action( 'guide_act', 'guide_say_ran' );
remove_action( 'guide_act', 'guide_say_ran' );
do_action( 'guide_act' );

return did_action( 'guide_act' );
