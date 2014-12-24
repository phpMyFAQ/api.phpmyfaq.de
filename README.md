# api.phpmyfaq.de

This subdomain provides informations about the latest stable and development releases from [phpMyFAQ](http://www.phpmyfaq.de).

## API endpoints

### api.phpmyfaq.de/version

    {
    
        "stable": "2.8.18",
        "development": "2.9.0-alpha"
    
    }
    
### api.phpmyfaq.de/verify/&lt;version&gt;

    {
    
        "created": "2014-11-30 11:24:38+01:00",
        "/add.php": "079e1ebf846535c45205cba1f66cedc16d8b9d7b",
        "/admin/ajax.attachment.php": "7d7297c5870fadf7c3568ecc6da8939b98124682",
        ...
    }
    
## Testing

Just use the built-in webserver from PHP:
 
    $ php -S localhost:3000
    
Routes:

    http://localhost:3000/index.php
    http://localhost:3000/version.php
    http://localhost:3000/verify.php?version=2.8.18
    
## License

Mozilla Public License 2.0, see LICENSE.md for more information.

Copyright (c) 2014 Thorsten Rinne