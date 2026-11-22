<?php
// Hooked to comment_form_defaults: in block themes, gives the comment form's submit button the button block's classes.
switch_theme( 'twentytwentyfive' );
$fields = comments_block_form_defaults( array( 'submit_field' => '<p class="form-submit">%1$s %2$s</p>' ) );
return $fields['submit_field'];
