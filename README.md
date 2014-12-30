# api.phpmyfaq.de

This subdomain provides informations about the latest stable and development releases from [phpMyFAQ](http://www.phpmyfaq.de).

## API endpoints

### api.phpmyfaq.de/versions

JSON Response:

    {
    
        "stable": "2.8.18",
        "stable_released": "2014-11-30",
        "development": "2.9.0-alpha",
        "development_released": "2014-08-12"
    
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

    "2.8.18"

### api.phpmyfaq.de/version/development

JSON Response:

    "2.9.0-alpha"
    
## Testing

Just use the built-in webserver from PHP:
 
    $ php -S localhost:3000
    
Requests:

    http://localhost:3000/index.php
    http://localhost:3000/version.php
    http://localhost:3000/verify.php?version=2.8.18
    
## License

Mozilla Public License 2.0, see LICENSE.md for more information.

Copyright (c) 2014 Thorsten Rinne