<?php
// It counts every time the action fired.
do_action( 'guide_twice' );
do_action( 'guide_twice' );

return array( did_action( 'guide_twice' ), did_action( 'guide_never' ) );
