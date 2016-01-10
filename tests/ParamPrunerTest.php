<?php

class ParamPrunerTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $this->assertEquals('https://www.google.de/search', \tzfrs\URLPruner\Pruners\ParamPruner::all($url));
    }

    public function testKeys()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $this->assertEquals('https://www.google.de/search?site=&source=hp&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M', \tzfrs\URLPruner\Pruners\ParamPruner::keys($url, ['num', 'q']));
    }

    public function testValues()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $this->assertEquals('https://www.google.de/search?q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M', \tzfrs\URLPruner\Pruners\ParamPruner::values($url, ['30', '', 'hp']));
    }

    public function testParse()
    {
        $url = 'https://www.google.de/search?num=30&site=&source=hp&q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M';

        $this->assertEquals('https://www.google.de/search?q=software+development&oq=Software+Development&gs_l=hp.3.0.0l10.464.4794.0.5387.31.18.3.7.8.0.185.1953.1j14.15.0....0...1c.1.64.hp..8.23.1779.0._BnKQF4413M', \tzfrs\URLPruner\Pruners\ParamPruner::parse($url, ['30', '', 'hp'], false));
    }

    public function testAllURLParts()
    {
        $url = 'http://username:password@hostname:9090/path?arg=value#anchor';

        $this->assertEquals($url, \tzfrs\URLPruner\Pruners\ParamPruner::parse($url, []));
    }

    public function testRepeatedParametersRemovingByValue()
    {
        $url = 'http://hostname/?a=1&a=2&a=3&b=4&b=5&b=6';

        $this->assertEquals('http://hostname/?a=1&a=3&b=4&b=5&b=6', \tzfrs\URLPruner\Pruners\ParamPruner::values($url, [2]));
    }

    public function testRepeatedParametersRemovingByKey()
    {
        $url = 'http://hostname/?a=1&a=2&a=3&b=4&b=5&b=6&c=7&c=8';

        $this->assertEquals('http://hostname/?a=1&a=2&a=3&b=4&b=5&b=6', \tzfrs\URLPruner\Pruners\ParamPruner::keys($url, ['c']));
    }

    public function testEncodedURLs()
    {
        $url = 'http://hostname/?x1=%21&x%40=2&x%23=%23';

        $this->assertEquals('http://hostname/?x1=%21&x%23=%23', \tzfrs\URLPruner\Pruners\ParamPruner::values($url, [2]));
    }
}