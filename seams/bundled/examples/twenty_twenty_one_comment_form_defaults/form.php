<?php
// Makes the comment box five rows tall; on comment_form_defaults.
guide_theme( 'twentytwentyone' );
return twenty_twenty_one_comment_form_defaults( array( 'comment_field' => '<textarea rows="8"></textarea>' ) )['comment_field'];
