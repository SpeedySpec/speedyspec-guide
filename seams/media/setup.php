<?php

declare(strict_types=1);

/**
 * Gives each Media example a freshly installed site, booted as WordPress boots (see `boot.php`),
 *  with the administrator `admin` (user 1) logged in.
 *
 *  {@link guide_go()} runs the main query for a URL as a front-end request would, so the template tags answer for
 *  that page.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

/**
 * Runs the main query for a URL of the site, as the front end would for that request.
 *
 * @param string $url
 *   A URL of the site, or a path or query string such as `/?p=1`.
 */
function guide_go(string $url): WP_Query
{
    $parts = parse_url($url);
    $_SERVER['REQUEST_URI'] = ($parts['path'] ?? '/') . (isset($parts['query']) ? '?' . $parts['query'] : '');
    $_GET = [];
    parse_str($parts['query'] ?? '', $_GET);
    $GLOBALS['wp']->main();
    return $GLOBALS['wp_query'];
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}

/**
 * Creates an image attachment as an upload would, with its sub-sizes in its metadata but no files on disk.
 *
 * Most media functions read only the attachment's metadata, so examples need no real image.
 *
 * @param array $fields
 *   Post fields of the attachment, over a published JPEG titled `Photo`.
 * @param int $width
 *   The full-size width.
 * @param int $height
 *   The full-size height.
 */
function guide_attachment(array $fields = [], int $width = 1200, int $height = 800): int
{
    $id = wp_insert_attachment(
        $fields + ['post_title' => 'Photo', 'post_mime_type' => 'image/jpeg', 'post_status' => 'inherit'],
        '2026/11/photo.jpg'
    );
    $sizes = [];
    foreach (['thumbnail' => [150, 150, true], 'medium' => [300, 300, false], 'large' => [1024, 1024, false]] as $name => [$w, $h, $crop])
    {
        if ($width <= $w && $height <= $h)
        {
            continue;
        }
        [$sw, $sh] = $crop ? [$w, $h] : wp_constrain_dimensions($width, $height, $w, $h);
        $sizes[$name] = ['file' => "photo-{$sw}x{$sh}.jpg", 'width' => $sw, 'height' => $sh, 'mime-type' => 'image/jpeg'];
    }
    wp_update_attachment_metadata($id, ['width' => $width, 'height' => $height, 'file' => '2026/11/photo.jpg', 'sizes' => $sizes]);
    return $id;
}

/**
 * Writes a real image file in the uploads folder, removed when the example ends, for functions that read the file.
 *
 * @param int $width
 *   The image's width.
 * @param int $height
 *   The image's height.
 * @param string $type
 *   `png`, `jpeg`, `gif` or `webp`.
 */
function guide_image(int $width = 40, int $height = 30, string $type = 'png'): string
{
    $path = wp_upload_dir()['path'] . "/guide-{$width}x{$height}.{$type}";
    wp_mkdir_p(dirname($path));
    $image = imagecreatetruecolor($width, $height);
    imagefill($image, 0, 0, imagecolorallocate($image, 30, 120, 200));
    ('image' . $type)($image, $path);
    register_shutdown_function('unlink', $path);
    return $path;
}
