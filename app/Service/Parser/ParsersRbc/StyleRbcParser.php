<?php
namespace App\Service\Parser\ParsersRbc;

use App\Service\Parser\IParser;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class StyleRbcParser implements IParser
{
    /**
     * @var Crawler
     */
    public function __construct(
        private Crawler $dom
    ){}

    /**
     * @inheritDoc
     */
    public function title(): string
    {
        try{
            $title = $this->dom->filter('.js-article-header .article__header');
            return  $title->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return  '';
    }

    /**
     * @inheritDoc
     */
    public function description(): string
    {
        try{
            $description = $this->dom->filter('.article .article__text');
            return  $description->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return  '';
    }

    /**
     * @inheritDoc
     */
    public function  imageUri(): string
    {
        try{
            $image = $this->dom->filter('.article__main-image__inner .js-rbcslider-image');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return  'https://via.placeholder.com/728x320.png';
    }
}
