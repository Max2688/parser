<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\StyleRbcParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorStyleRbcParser extends ParserFactory
{
    /**
     * @var Crawler
     */
    private Crawler $dom;

    const URI = "/style.rbc/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return IParser
     */
    public function getParser(): IParser
    {
        return new StyleRbcParser($this->dom);
    }
}
