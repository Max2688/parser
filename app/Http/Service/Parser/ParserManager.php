<?php

namespace  App\Http\Service\Parser;

use App\Http\Service\Parser\Creators\CreatorRBCParser;
use App\Http\Service\Parser\Creators\CreatorStyleRbcParser;
use App\Http\Service\Parser\Creators\CreatorAgroDigitalRbcParser;
use App\Http\Service\Parser\Creators\CreatorKorrespondentParser;
use App\Http\Service\Parser\Creators\CreatorAutonewsParser;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Intervention\Image\Facades\Image as ImageLib;

use App\Post;

class ParserManager
{

    private $url;
    private $contentPart;

    public function __construct($url,$contentPart = '')
    {
        $this->url = $url;
        $this->contentPart = $contentPart;
    }

    public function init()
    {
        if (!empty($this->contentPart)) {
            // Get all links of content part
            $html = $this->getHtml($this->url);
            $crawler = $this->getCrawler($html);
            $links = $this->getContentPartItems($crawler);

            foreach ($links as $link) {
                $parser = $this->getCurrentParser($link);
                $this->saveImg(trim($parser->imageUri()));
                $this->saveModel($link);
                $this->logStatus($link);
            }
        } else {
            $parser = $this->getCurrentParser($this->url);
            $this->saveImg(trim($parser->imageUri()));
            $this->saveModel($this->url);
            $this->logStatus($this->url);
        }
    }

    private function getHtml($url)
    {
        $response = Http::get($url);
        return $response->body();
    }

    private function getCrawler($html)
    {
        return new Crawler($html);
    }

    private function getContentPartItems(Crawler $crawler)
    {
        $links = $crawler->filter($this->contentPart)->each(function (Crawler $node, $i){
            return $node->link()->getUri();
        });

        return $links;
    }

    private function getCurrentParser($url)
    {

        $html =  $this->getHtml($url);
        $crawler = $this->getCrawler($html);
        switch (true){
            case preg_match(CreatorStyleRbcParser::uri, $url):
                $currentParser = new CreatorStyleRbcParser($crawler);
                break;
            case preg_match(CreatorAgroDigitalRbcParser::uri, $url):
                $currentParser = new CreatorAgroDigitalRbcParser($crawler);
                break;
            case preg_match(CreatorKorrespondentParser::uri, $url):
                $currentParser = new CreatorKorrespondentParser($crawler);
                break;
            case preg_match(CreatorAutonewsParser::uri, $url):
                $currentParser = new CreatorAutonewsParser($crawler);
                break;
            default:
                $currentParser = new CreatorRBCParser($crawler);
        }

        return $currentParser->getParser();

    }

    private function saveImg($imgUri)
    {

        $filename = basename($imgUri);
        ImageLib::make($imgUri)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->save(storage_path('app/public') . DIRECTORY_SEPARATOR . $filename);

    }

    private function saveModel($url)
    {
        $parser = $this->getCurrentParser($url);
        $post = new Post();
        $post->title = trim($parser->title());
        $post->image = basename($parser->imageUri());
        $post->description = trim(strip_tags($parser->description(), '<p><a><span><ul><li>'));
        $post->save();
    }

    private function logStatus($url)
    {
        $parser = $this->getCurrentParser($url);
        echo 'Парсим...' . '<br/>';
        echo $url . '<br/>';
        $title = empty($parser->title()) ? 'Не спарсили заголовок ' : 'Cпарсили заголовок ';
        $text = empty($parser->description()) ? 'Не спарсили текст ' : 'Cпарсили текст ';
        echo $title . $text . '<br/>';
    }
}