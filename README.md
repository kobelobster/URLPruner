# URL Pruner
An easy-to-use library to prune URLs

## Install

Install via [composer](https://getcomposer.org):

```bash
composer require tzfrs\urlpruner
```

Run `composer install` or `composer update`.

## Methods

`anythingAfter` - Removes everything from the URL after a character/word

`regex` - Removes parts of the URL based on the Regex

`parameters` - Removes parameters with specific keys
 
`allParameters` - Removes all parameters

`parameterValues` - Removes all parameters with keys that have a specific value
 
`prune` - Actually performs the pruning


## Getting Started

### Basic pruning

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

$urlPruner = new \tzfrs\URLPruner\URLPruner();

print $urlPruner->anythingAfter('search')
    ->prune($url); // https://www.google.de/search

print $urlPruner->regex('search')
    ->prune($url); // https://www.google.de/?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M

print $urlPruner->parameters(['num', 'q'])
    ->prune($url); // https://www.google.de/search?site=&source=hp&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M

print $urlPruner->allParameters()
    ->prune($url); // https://www.google.de/search

print $urlPruner->parameterValues(['30', '', 'hp'])
    ->prune($url); // https://www.google.de/search?q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M
```

Contributing is surely allowed! :-)

See the file `LICENSE` for licensing informations