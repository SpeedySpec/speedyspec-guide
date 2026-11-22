<?php

declare(strict_types=1);

/**
 * Gives each developer guide example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1) logged in.
 *
 *  Guide examples show a plugin's code working across WordPress's APIs together, so they need all of WordPress
 *  loaded rather than one seam's files.
 */

require __DIR__ . '/../boot.php';
