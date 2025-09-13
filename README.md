# api.phpmyfaq.de

This subdomain provides information about the latest stable and development releases from
[phpMyFAQ](https://www.phpmyfaq.de).

## API endpoints

### api.phpmyfaq.de/versions

JSON Response:

    {
        "stable": "3.2.1",
        "stable_released": "2023-09-21",
        "development": "4.0.0-alpha",
        "development_released": "2023-09-21"
        "nightly: "2023-09-21",
        "nightly_released: "2023-09-21"
    }

### api.phpmyfaq.de/verify/<version>

JSON Response:

    {
        "created": "2014-11-30 11:24:38+01:00",
        "/add.php": "079e1ebf846535c45205cba1f66cedc16d8b9d7b",
        "/admin/ajax.attachment.php": "7d7297c5870fadf7c3568ecc6da8939b98124682",
        ...
    }

### api.phpmyfaq.de/version/stable

JSON Response:

    "3.2.1"

### api.phpmyfaq.de/version/development

JSON Response:

    "4.0.0-alpha"

### api.phpmyfaq.de/version/nightly

JSON Response:

    "nightly-4.0.0-alpha"

## Testing

Just use the built-in web server from PHP:

    $ php -S localhost:3000

Requests:

    http://localhost:3000/index.php
    http://localhost:3000/version.php
    http://localhost:3000/verify.php?version=2.8.18

## License

Mozilla Public License 2.0, see LICENSE.md for more information.

Copyright © 2014-2023 Thorsten Rinne


<!-- Added: Symfony-like lightweight front controller + routing -->

## Lightweight Symfony-based front controller

- Front controller: `public/index.php` using `symfony/http-foundation` and `symfony/routing`.
- Controller: `src/Controller/ApiController.php` implements all endpoints.
- Apache rewrites: root `.htaccess` forwards all requests to `public/`, and `public/.htaccess` routes to the front controller.
- CORS support: default `Access-Control-*` headers and `OPTIONS` preflight handling.

### Requirements
- PHP >= 8.2

### Local run
Install deps and start a local server:

```bash
composer install
composer serve
# or
php -S 127.0.0.1:3000 -t public public/index.php
```

Try:

```bash
curl http://127.0.0.1:3000/
curl http://127.0.0.1:3000/versions
curl http://127.0.0.1:3000/version/stable
curl "http://127.0.0.1:3000/verify/2.8.18"
```

### Notes
- Nightly value is generated as `nightly-<yesterday>`; its release date equals yesterday.
- `verify` responds with 418 for missing or invalid versions.
- CORS headers are always present; `OPTIONS` returns 204.
