<?php

class URLPrunerTest extends PHPUnit_Framework_TestCase
{
    public function testAnythingAfter()
    {
        $urlPruner = new \tzfrs\URLPruner\URLPruner();

        $wildcard = 'x';

        $this->assertInstanceOf(\tzfrs\URLPruner\URLPruner::class, $urlPruner->anythingAfter($wildcard));
    }

    public function testRegex()
    {
        $urlPruner = new \tzfrs\URLPruner\URLPruner();

        $regex = 'x';

        $this->assertInstanceOf(\tzfrs\URLPruner\URLPruner::class, $urlPruner->regex($regex));
    }

    public function testParameters()
    {
        $urlPruner = new \tzfrs\URLPruner\URLPruner();

        $parameters = 'x';

        $this->assertInstanceOf(\tzfrs\URLPruner\URLPruner::class, $urlPruner->parameters($parameters));
    }

    public function testAllParameters()
    {
        $urlPruner = new \tzfrs\URLPruner\URLPruner();

        $this->assertInstanceOf(\tzfrs\URLPruner\URLPruner::class, $urlPruner->allParameters());
    }

    public function testParameterValues()
    {
        $urlPruner = new \tzfrs\URLPruner\URLPruner();

        $parameters = 'x';

        $this->assertInstanceOf(\tzfrs\URLPruner\URLPruner::class, $urlPruner->parameterValues($parameters));
    }

   public function testPrune()
   {
       $urlPruner = new \tzfrs\URLPruner\URLPruner();

       $url = 'x';

       $this->assertEquals($url, $urlPruner->prune($url));
   }
}