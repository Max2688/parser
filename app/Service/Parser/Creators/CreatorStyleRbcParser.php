<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\StyleRbcParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorStyleRbcParser extends ParserFactory
{
    const URI = "/style.rbc/iu";

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
        return new StyleRbcParser($this->dom);
    }
}
