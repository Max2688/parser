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
    private Crawler $dom;

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    /**
     * @return string
     */
    public function title()
    {
        try{
            $title = $this->dom->filter('.js-article-header .article__header');
            return  $title->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return  '';
        }
    }

    /**
     * @return string
     */
    public function description()
    {
        try{
            $description = $this->dom->filter('.article .article__text');
            return  $description->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return  '';
        }
    }

    /**
     * @return string
     */
    public function  imageUri()
    {
        try{
            $image = $this->dom->filter('.article__main-image__inner .js-rbcslider-image');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return  'https://via.placeholder.com/728x320.png';
        }

    }
}
