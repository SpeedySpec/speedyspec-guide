<?php
// Slashes every string in an array, nested arrays included; other values are left alone.
return add_magic_quotes( array( "it's", array( 'a"b' ), 5 ) );
