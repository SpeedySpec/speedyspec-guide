<?php
// Moves Prototype before jQuery in a list of scripts to print, so jQuery's $ isn't taken by it.
return array( wp_prototype_before_jquery( array( 'jquery', 'a', 'prototype' ) ), wp_prototype_before_jquery( array( 'a', 'jquery' ) ) );
