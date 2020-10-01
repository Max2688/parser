<?php

namespace  App\Http\Service\Parser\Creators;

use App\Http\Service\Parser\ParserFactory;
use App\Http\Service\Parser\ParsersRbc\AgroDigitalParser;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Service\Parser\IParser;

class CreatorAgroDigitalRbcParser extends ParserFactory
{
    private $dom;
    const uri = "/agrodigital.rbc/iu";
    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function getParser(): IParser
    {
        return new AgroDigitalParser($this->dom);
    }
}