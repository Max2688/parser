<?php

namespace  App\Http\Service\Parser\Creators;

use App\Http\Service\Parser\ParserFactory;
use App\Http\Service\Parser\ParsersRbc\StyleRbcParser;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Service\Parser\IParser;

class CreatorStyleRbcParser extends ParserFactory
{
    private $dom;
    const uri = "/style.rbc/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function getParser(): IParser
    {
        return new StyleRbcParser($this->dom);
    }
}