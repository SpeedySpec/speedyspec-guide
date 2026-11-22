<?php
// Adds do-not-scroll to the comment reply link's classes; on comment_reply_link.
guide_theme( 'twentytwenty' );
return twentytwenty_filter_comment_reply_link( "<a class='comment-reply-link' href='#'>Reply</a>" );
