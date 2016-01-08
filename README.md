# URL Pruner
An easy-to-use library to prune URLs

## Install

Install via [composer](https://getcomposer.org):

```bash
composer require tzfrs\urlpruner
```

Run `composer install` or `composer update`.

## Getting Started

### Basic parsing
Parses the data from the sitemap.xml of your server. Supports .xml and text format

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use \tzfrs\GoogleSitemapParser;
use \tzfrs\Exceptions\GoogleSitemapParserException;

try {
    $posts = (new GoogleSitemapParser('http://tzfrs.de/sitemap.xml'))->parse();
    foreach ($posts as $post) {
        print $post . '<br>';
    }
} catch (GoogleSitemapParserException $e) {
    print $e->getMessage();
}
```

### Parsing from robots.txt
Searches for Sitemap entries in the robots.txt and parses those files. Also downloads/extracts gzip compressed sitemaps and searches for them

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use \tzfrs\GoogleSitemapParser;
use \tzfrs\Exceptions\GoogleSitemapParserException;

try {
    $posts = (new GoogleSitemapParser('http://www.sainsburys.co.uk/robots.txt'))->parseFromRobots();
    foreach ($posts as $post) {
        print $post . '<br>';
    }
} catch (GoogleSitemapParserException $e) {
    print $e->getMessage();
}
```

### Including the priority for the sitemap entry in the response
If you also want to get the priority of a sitemap set the 2nd parameter of the constructor to true
If the priority can't be found or is not set in the file an empty string will be returned.

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use \tzfrs\GoogleSitemapParser;
use \tzfrs\Exceptions\GoogleSitemapParserException;
try {
    $posts = (new GoogleSitemapParser('http://www.sainsburys.co.uk/robots.txt', true))->parseFromRobots();
    foreach ($posts as $post=>$priority) {
        print 'URL: '. $post . '<br>Priority: '. $priority . '<hr>';
    }
} catch (GoogleSitemapParserException $e) {
    print $e->getMessage();
}
```

### Parsing compressed sitemaps
If you have an URL to a compressed sitemap such as example.com/sitemap.xml.gz then you need to use this method

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use \tzfrs\GoogleSitemapParser;
use \tzfrs\Exceptions\GoogleSitemapParserException;
try {
    $posts = (new GoogleSitemapParser('http://www.sainsburys.co.uk/wcsstore/robots/sitemap_10151_4.xml.gz'))->parseCompressed();
    foreach ($posts as $post=>$priority) {
        print 'URL: '. $post . '<br>Priority: '. $priority . '<hr>';
    }
} catch (GoogleSitemapParserException $e) {
    print $e->getMessage();
}
```

## Methods

`parse`
`parseFromRobots`

Contributing is surely allowed! :-)

See the file `LICENSE` for licensing informations