<?php
// Adds slashes to strings, in arrays too; other values are returned as they are.
return wp_slash( array( "it's", array( 'a"b' ), 5 ) );
