<?php
// Filters a block attribute value (string or array) through kses.
return filter_block_kses_value( array( 'a' => '<script>x</script>ok', 'b' => array( '<i>y</i>' ) ), 'post' );
