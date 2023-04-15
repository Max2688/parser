<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\KorrespondentParser;
use App\Service\Parser\ParserFactory;
use Symfony\Component\DomCrawler\Crawler;

class CreatorKorrespondentParser extends ParserFactory
{
    const URI = "/korrespondent.net/iu";

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
        return new KorrespondentParser($this->dom);
    }
}
