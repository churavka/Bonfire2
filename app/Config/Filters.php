<?php

namespace Config;

use App\Filters\Admin;
use Bonfire\Consent\Filters\ConsentFilter;
use Bonfire\Filters\OnlineCheck;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;
use Sparks\Shield\Filters\ChainAuth;
use Sparks\Shield\Filters\SessionAuth;
use Sparks\Shield\Filters\TokenAuth;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'session'       => SessionAuth::class,
        'tokens'        => TokenAuth::class,
        'chain'         => ChainAuth::class,
        'online'        => OnlineCheck::class,
        'consent'       => ConsentFilter::class,
        'admin'         => Admin::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'online' => ['except' => 'site-offline'],
        ],
        'after' => [
            'alerts',
            'toolbar',
            'consent' => ['except' => ADMIN_AREA . '*'],
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'session' => [
            'before' => [ADMIN_AREA . '*'],
        ],
        'admin' => [
            'before' => [ADMIN_AREA . '*'],
        ],
    ];
}
