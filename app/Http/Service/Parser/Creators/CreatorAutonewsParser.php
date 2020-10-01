<?php

namespace  App\Http\Service\Parser\Creators;

use App\Http\Service\Parser\ParserFactory;
use App\Http\Service\Parser\ParsersRbc\AutonewsParser;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Service\Parser\IParser;

class CreatorAutonewsParser extends ParserFactory
{
    private $dom;
    const uri = "/autonews.ru/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function getParser(): IParser
    {
        return new AutonewsParser($this->dom);
    }
}