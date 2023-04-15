<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\AutonewsParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorAutonewsParser extends ParserFactory
{
    const URI = "/autonews.ru/iu";

    /**
     * @var Crawler
     */
    public function __construct(
        private Crawler $dom
    ){}


    /**
     * @return IParser
     */
    public function getParser(): IParser
    {
        return new AutonewsParser($this->dom);
    }
}
