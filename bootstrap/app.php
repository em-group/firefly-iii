<?php
/**
 * app.php
 * Copyright (c) 2017 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);


/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/


bcscale(12);

if (!function_exists('envNonEmpty')) {
    /**
     * @param string $key
     * @param null   $default
     *
     * @return mixed|null
     */
    function envNonEmpty(string $key, $default = null)
    {
        $result = env($key, $default);
        if (is_string($result) && '' === $result) {
            $result = $default;
        }

        return $result;
    }
}

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__ . '/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    FireflyIII\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    FireflyIII\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    FireflyIII\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Overload environment, for the current domain
|--------------------------------------------------------------------------
|
| We do this so we can use a single codebase, for multiple VHosts.
| Each VHost can then overwrite all, or none, of the master environment
| settings, to specify anything from a custom app name, to using a
| different database.
|
*/
if (!empty($_SERVER['HTTP_HOST'])) {
    // Get the hostname, without TLD
    $host = parse_url($_SERVER['HTTP_HOST'])['host'];
    $host = explode('.', $host);
    array_pop($host);
    $domainNoTLD = implode('.', $host);
    // We expect to find a environment file, named in the format of .env.sub.%hostname%
    // within the application root
    $envFile = realpath(__DIR__ . '/../.env.sub.' . $domainNoTLD);
    if (false !== $envFile && file_exists($envFile)) {
        \Dotenv\Dotenv::create('/../', $envFile)->overload();
    }
}

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/

return $app;
