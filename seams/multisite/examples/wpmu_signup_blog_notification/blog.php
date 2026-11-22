<?php
// Emails a site sign-up its activation link; wpmu_signup_blog_notification can stop it, and its subject and text are filtered.
return wpmu_signup_blog_notification( 'example.org', '/team/', 'Team', 'teamlead', 'lead@example.org', 'abc123' );
