Scrape web pages and structure results

[![Latest Stable Version](https://poser.pugx.org/userforce/scraper/v/stable)](https://packagist.org/packages/userforce/scraper)
[![Total Downloads](https://poser.pugx.org/userforce/scraper/downloads)](https://packagist.org/packages/userforce/scraper)
[![composer.lock](https://poser.pugx.org/userforce/scraper/composerlock)](https://packagist.org/packages/userforce/scraper)

# Installation
Require this package with Composer

```bash
composer require userforce/scraper
```

Register Scraper with Laravel. Open config/app.php and add ```UserForce\ScraperServiceProvider``` at the end of providers list

```php
'providers' => [
    ...
    UserForce\Scraper\ScraperServiceProvider::class,
],
```

Then at the end of the aliases list in the same config/app.php add ```UserForce\Facade\Scraper```

```php
'aliases' => [
    ...
    'Scraper' => UserForce\Scraper\Facade\Scraper::class,
],
```

You can now begin using Scraper

# Usage
:TODO