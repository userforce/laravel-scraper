Scrape web pages and structure results

[![Latest Stable Version](https://poser.pugx.org/userforce/laravel-scraper/v/stable)](https://packagist.org/packages/userforce/laravel-scraper)
[![Total Downloads](https://poser.pugx.org/userforce/laravel-scraper/downloads)](https://packagist.org/packages/userforce/laravel-scraper)
[![composer.lock](https://poser.pugx.org/userforce/laravel-scraper/composerlock)](https://packagist.org/packages/userforce/laravel-scraper)

# Installation
Require this package with Composer

```bash
composer require rcrowe/twigbridge
```

Register Scraper with Laravel. Open config/app.php and add ```UserForce\ScraperServiceProvider``` at the end of providers list

```php
'providers' => [
    ...
    UserForce\ScraperServiceProvider::class,
],
```

Then at the end of the aliases list in the same config/app.php add ```UserForce\Facade\Scraper```

```php
'aliases' => [
    ...
    'Scraper' => UserForce\Facade\Scraper::class,
],
```

You can now begin using Scraper

# Usage
:TODO