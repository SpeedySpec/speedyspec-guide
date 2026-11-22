<?php
// Whether a comment's author, email, URL, content, IP or agent contains a disallowed word (disallowed_keys); fires wp_check_comment_disallowed_list.
update_option( 'disallowed_keys', "casino\n10.0.0." );
return array( wp_check_comment_disallowed_list( 'Ada', 'ada@example.org', '', 'Nice', '1.2.3.4', 'x' ), wp_check_comment_disallowed_list( 'Ada', 'ada@example.org', '', 'Win at the casino', '1.2.3.4', 'x' ), wp_check_comment_disallowed_list( 'Ada', 'ada@example.org', '', 'Hi', '10.0.0.5', 'x' ) );
