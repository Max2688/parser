<?php

namespace App\Service\Contracts;

use App\Service\Parser\IParser;
use Symfony\Component\DomCrawler\Crawler;

interface ParserServiceContract
{
    /**
     * @param string $url
     * @return string
     */
    public function getHttpResponse(string $url): string;

    /**
     * @param string $html
     * @return Crawler
     */
    public function getCrawler(string $html): Crawler;

    /**
     * @param Crawler $crawler
     * @return array
     */
    public function getLinksFromNodeSelector(Crawler $crawler, string $nodeSelector): array;

    /**
     * @param string $url
     * @return IParser
     */
    public function getCurrentParser(string $url): IParser;
}
