<?php

namespace  App\Service\Parser;

use App\Service\Contracts\ParserServiceContract;
use App\Service\Parser\Creators\CreatorAgroDigitalRbcParser;
use App\Service\Parser\Creators\CreatorAutonewsParser;
use App\Service\Parser\Creators\CreatorKorrespondentParser;
use App\Service\Parser\Creators\CreatorRBCParser;
use App\Service\Parser\Creators\CreatorStyleRbcParser;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ParserService implements ParserServiceContract
{
    /**
     * @inheritDoc
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
     * @inheritDoc
     */
    public function getCrawler(string $html): Crawler
    {
        return new Crawler($html);
    }

    /**
     * @inheritDoc
     */
    public function getLinksFromNodeSelector(Crawler $crawler, string $nodeSelector): array
    {
        return $crawler->filter($nodeSelector)->each(function (Crawler $node){
            return $node->link()->getUri();
        });
    }

    /**
     * @inheritDoc
     */
    public function getCurrentParser(string $url): IParser
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
