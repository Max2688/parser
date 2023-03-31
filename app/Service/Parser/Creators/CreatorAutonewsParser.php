<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\AutonewsParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorAutonewsParser extends ParserFactory
{
    /**
     * @var Crawler
     */
    private Crawler $dom;

    const URI = "/autonews.ru/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return IParser
     */
    public function getParser(): IParser
    {
        return new AutonewsParser($this->dom);
    }
}
