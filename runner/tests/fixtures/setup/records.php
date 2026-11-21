<?php
// A seam's setup: records what it saw, and defines MULTISITE as WordPress's multisite config would.
define('GUIDE_SETUP_SAW', GUIDE_MULTISITE ? 'multisite' : 'single');
if (GUIDE_MULTISITE) {
    define('MULTISITE', true);
}
