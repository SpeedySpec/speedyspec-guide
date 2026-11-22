<?php

declare(strict_types=1);

/**
 * Gives each REST API example a freshly installed site, booted as WordPress boots (see `boot.php`), with the
 *  administrator `admin` (user 1) logged in.
 *
 *  {@link guide_rest()} dispatches a request to the REST server, which registers WordPress's routes on its first use
 *  (`rest_api_init`), and gives back the response's status and data.
 */

require __DIR__ . '/../boot.php';

foreach (['function', 'argument', 'file', 'hook', 'constructor', 'class'] as $guide_kind)
{
    add_filter("deprecated_{$guide_kind}_trigger_error", '__return_false');
}
add_filter('doing_it_wrong_trigger_error', '__return_false');
unset($guide_kind);

/**
 * Dispatches a REST request in the same process and gives back its status and data.
 *
 * @param string $method
 *   The HTTP method, such as `GET`.
 * @param string $route
 *   The route, such as `/wp/v2/posts`.
 * @param array<string, mixed> $params
 *   The request's parameters: the query for `GET`, the body otherwise.
 *
 * @return array{0: int, 1: mixed}
 *   The status and the response data.
 */
function guide_rest(string $method, string $route, array $params = []): array
{
    $request = new WP_REST_Request($method, $route);
    if ('GET' === $method)
    {
        $request->set_query_params($params);
    }
    else
    {
        $request->set_body_params($params);
    }
    $response = rest_get_server()->dispatch($request);
    return [$response->get_status(), $response->get_data()];
}

/** Runs a function that prints and gives back what it printed, each run of whitespace collapsed to one space. */
function guide_render(callable $print): string
{
    ob_start();
    $print();
    return trim(preg_replace('/\s+/', ' ', ob_get_clean()));
}
