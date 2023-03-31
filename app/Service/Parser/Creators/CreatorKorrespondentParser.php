<?php

namespace  App\Service\Parser\Creators;

use App\Service\Parser\IParser;
use App\Service\Parser\KorrespondentParser;
use App\Service\Parser\ParserFactory;
use Symfony\Component\DomCrawler\Crawler;

class CreatorKorrespondentParser extends ParserFactory
{
    /**
     * @var Crawler
     */
    private Crawler $dom;

    const URI = "/korrespondent.net/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return IParser
     */
    public function getParser(): IParser
    {
        return new KorrespondentParser($this->dom);
    }
}
