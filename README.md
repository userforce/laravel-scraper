Scrape web pages and structure results using regular expressions.

[![Latest Stable Version](https://poser.pugx.org/userforce/scraper/version)](https://packagist.org/packages/userforce/scraper)
[![Total Downloads](https://poser.pugx.org/userforce/scraper/downloads)](https://packagist.org/packages/userforce/scraper)
[![composer.lock](https://poser.pugx.org/userforce/scraper/composerlock)](https://packagist.org/packages/userforce/scraper)

### Installation
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

### Usage
```php
use Scraper;
```
Scraper has one method `find` that accepts one parameter:
 
```php
$result = Scraper::find($config);
```

### Example

Each config option must have to keys `url` and `regex`.  
You can define multiple config options in a tree ( the structure will be kept ).  
Also `regex` can be a string or an associative array and can't be empty. Each string will be interpreted as regular expression.

```php
$config = [
    'ibmachine' => [
        'url' => 'https://ibmachine.com/machine',
        'regex' => [
            'name' => 'machine\/view\/[0-9]{1,7}" itemprop="name">\s*(<span.*\/span>)?\s*(.*)\s*<\/a>',
            'links' => [
                'url' => 'href=\"(http.*machine\/view\/[\d]{1,7})\"\sitemprop'
            ]
        ]
    ]
];

$result = Scraper::find($config);

$result->get();
```

####Result:
```php
array:1 [▼
  "ibmachine" => array:2 [▼
    "name" => array:3 [▼
      0 => array:20 [▶]
      1 => array:20 [▶]
      2 => array:20 [▼
        0 => "Alesatrice TOS Whn q 13 anno 2001"
        1 => "CURVATRICE TAURING mod. DELTA 60 CNC"
        2 => "Calandre idrauliche 3 rulli"
        ...
      ]
    ]
    "links" => array:1 [▼
      "url" => array:2 [▼
        0 => array:20 [▶]
        1 => array:20 [▶]
      ]
    ]
  ]
]
```