<?php

class StringPrunerTest extends PHPUnit_Framework_TestCase
{
    public function testAnythingAfter()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $wildcard = 'search';

        $this->assertEquals('https://www.google.de/search', \tzfrs\URLPruner\Pruners\StringPruner::anythingAfter($url, $wildcard));
    }
}