<?php

declare(strict_types=1);

/**
 * The shared basic setup, plus a transport that answers from a queue.
 *
 *  Requests sent with the `transport` option set to
 *  `Guide_Queue_Transport` never leave the machine: each gets the next raw HTTP response queued with
 *  `Guide_Queue_Transport::$responses`, and the request is recorded in `Guide_Queue_Transport::$sent`, so the
 *  library's parsing, redirects, cookies and hooks run on real responses. `guide_queue_http()` routes WordPress's HTTP
 *  API through it. The site is `http://example.org`; reading an option it doesn't answer throws, naming it.
 */

require __DIR__ . '/../basic-setup.php';

foreach ([
    'home' => 'http://example.org',
    'siteurl' => 'http://example.org',
] as $guide_name => $guide_value)
{
    add_filter("pre_option_{$guide_name}", static fn () => $guide_value);
}
// Any other option would be read from the database; say which instead of failing on a missing $wpdb.
add_filter('pre_option', static function ($pre, $name) { if (false === $pre) { throw new RuntimeException('unanswered option ' . $name); } return $pre; }, 99, 2);
$GLOBALS['wp_version'] = '7.2';
unset($guide_name, $guide_value);

WpOrg\Requests\Autoload::register();
WpOrg\Requests\Requests::set_certificate_path(ABSPATH . WPINC . '/certificates/ca-bundle.crt');

/** A transport that answers each request with the next queued raw response. */
final class Guide_Queue_Transport implements WpOrg\Requests\Transport
{
    /** @var list<string> The raw responses to give, in order. */
    public static array $responses = [];

    /** @var list<array{url: string, headers: array, data: mixed, method: string}> The requests sent. */
    public static array $sent = [];

    public function request($url, $headers = [], $data = [], $options = [])
    {
        self::$sent[] = ['url' => $url, 'headers' => $headers, 'data' => $data, 'method' => $options['type']];
        return array_shift(self::$responses) ?? "HTTP/1.1 500 No response queued\r\n\r\n";
    }

    public function request_multiple($requests, $options)
    {
        $out = [];
        foreach ($requests as $id => $request)
        {
            $out[$id] = $this->request($request['url'], $request['headers'], $request['data'], $request['options']);
            $request['options']['hooks']->dispatch('transport.internal.parse_response', [&$out[$id], $request]);
        }
        return $out;
    }

    public static function test($capabilities = [])
    {
        return true;
    }
}

/**
 * Sends the HTTP API's requests through `Guide_Queue_Transport`, by setting the transport on Requests'
 *  `requests.before_request` hook, which WordPress relays as the `requests-requests.before_request` action.
 */
function guide_queue_http(string ...$responses): void
{
    Guide_Queue_Transport::$responses = $responses;
    add_action('requests-requests.before_request', static function (&$url, &$headers, &$data, &$type, &$options): void {
        $options['transport'] = 'Guide_Queue_Transport';
    }, 10, 5);
}
