<?php

namespace  App\Http\Service\Parser\Creators;

use App\Http\Service\Parser\ParserFactory;
use App\Http\Service\Parser\ParsersRbc\RBCParser;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Service\Parser\IParser;

class CreatorRBCParser extends ParserFactory
{
    private $dom;

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function getParser(): IParser
    {
        return new RBCParser($this->dom);
    }
}