<?php
// Hooked to comment_form_defaults while the Comments Form block renders: in block themes, gives the submit button the button block's classes.
switch_theme( 'twentytwentyfive' );
$fields = post_comments_form_block_form_defaults( array( 'submit_field' => '<p class="form-submit">%1$s %2$s</p>' ) );
return $fields['submit_field'];
