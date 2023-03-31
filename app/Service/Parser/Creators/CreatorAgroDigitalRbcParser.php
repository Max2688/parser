<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\ParserFactory;
use App\Service\Parser\ParsersRbc\AgroDigitalParser;
use Symfony\Component\DomCrawler\Crawler;

class CreatorAgroDigitalRbcParser extends ParserFactory
{
    /**
     * @var Crawler
     */
    private $dom;

    const URI = "/agrodigital.rbc/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return IParser
     */
    public function getParser(): IParser
    {
        return new AgroDigitalParser($this->dom);
    }
}
