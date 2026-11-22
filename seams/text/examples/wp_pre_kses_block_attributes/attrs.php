<?php
// Runs kses over block comment attributes too: a script in an attribute is removed with its contents.
return wp_pre_kses_block_attributes( '<!-- wp:p {"a":"<script>x</script>b"} /-->', 'post', array( 'http' ) );
