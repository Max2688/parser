<?php

namespace  App\Http\Service\Parser\Creators;

use App\Http\Service\Parser\ParserFactory;
use App\Http\Service\Parser\KorrespondentParser;
use Symfony\Component\DomCrawler\Crawler;
use App\Http\Service\Parser\IParser;

class CreatorKorrespondentParser extends ParserFactory
{
    private $dom;
    const uri = "/korrespondent.net/iu";

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function getParser(): IParser
    {
        return new KorrespondentParser($this->dom);
    }
}