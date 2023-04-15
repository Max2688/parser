<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\AgroDigitalParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorAgroDigitalRbcParser extends ParserFactory
{
    const URI = "/agrodigital.rbc/iu";

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
        return new AgroDigitalParser($this->dom);
    }
}
