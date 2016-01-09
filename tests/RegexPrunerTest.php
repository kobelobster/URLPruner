<?php

class RegexPrunerTest extends PHPUnit_Framework_TestCase
{
    public function testReplace()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $wildcard = 'search';

        $this->assertEquals('https://www.google.de/?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M', \tzfrs\URLPruner\Pruners\RegexPruner::replace($url, $wildcard));
    }

    public function testReservedChar()
    {
        $url = 'http://hostname/something.html#anchor-5';

        $wildcard = '#anchor';

        $this->assertEquals('http://hostname/something.html-5', \tzfrs\URLPruner\Pruners\RegexPruner::replace($url, $wildcard));
    }
}