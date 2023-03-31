<?php

namespace  App\Service\Parser;

use App\Service\Parser\Creators\CreatorAgroDigitalRbcParser;
use App\Service\Parser\Creators\CreatorAutonewsParser;
use App\Service\Parser\Creators\CreatorKorrespondentParser;
use App\Service\Parser\Creators\CreatorRBCParser;
use App\Service\Parser\Creators\CreatorStyleRbcParser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ParserService
{
    /**
     * @param string $url
     * @return string
     */
    public function getHttpResponse(string $url): string
    {
        try{
            $response = Http::get($url);
            return $response->body();
        } catch (ConnectionException $e){
            Log::info($e->getMessage());
        }

        return '';
    }

    /**
     * @param string $html
     * @return Crawler
     */
    public function getCrawler(string $html)
    {
        return new Crawler($html);
    }

    /**
     * @param Crawler $crawler
     * @return array
     */
    public function getLinksFromNodeSelector(Crawler $crawler, string $nodeSelector)
    {
        return $crawler->filter($nodeSelector)->each(function (Crawler $node){
            return $node->link()->getUri();
        });
    }

    /**
     * @param string $url
     * @return IParser
     */
    public function getCurrentParser(string $url)
    {
        $html = $this->getHttpResponse($url);
        $crawler = $this->getCrawler($html);

        switch (true){
            case preg_match(CreatorStyleRbcParser::URI, $url):
                $currentParser = new CreatorStyleRbcParser($crawler);
                break;
            case preg_match(CreatorAgroDigitalRbcParser::URI, $url):
                $currentParser = new CreatorAgroDigitalRbcParser($crawler);
                break;
            case preg_match(CreatorKorrespondentParser::URI, $url):
                $currentParser = new CreatorKorrespondentParser($crawler);
                break;
            case preg_match(CreatorAutonewsParser::URI, $url):
                $currentParser = new CreatorAutonewsParser($crawler);
                break;
            default:
                $currentParser = new CreatorRBCParser($crawler);
        }

        return $currentParser->getParser();
    }
}
