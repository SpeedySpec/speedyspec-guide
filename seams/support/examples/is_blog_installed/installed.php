<?php
// Whether WordPress is installed: siteurl is in the options table; when it isn't but some WordPress tables exist, it stops with a repair message. The answer is cached.
return is_blog_installed();
