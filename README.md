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

### api.phpmyfaq.de/verify/&lt;version&gt;

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
