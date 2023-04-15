<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\RBCParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorRBCParser extends ParserFactory
{
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
        return new RBCParser($this->dom);
    }
}
