<?php
namespace App\Service\Parser\ParsersRbc;

use App\Service\Parser\IParser;
use Symfony\Component\DomCrawler\Crawler;

class AgroDigitalParser implements IParser
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
            $title = $this->dom->filter('.article__header .article__header__title .js-slide-title');
            return $title->html();
        } catch (\InvalidArgumentException $e){
            return  '';
        }

    }

    /**
     * @return string
     */
    public function description()
    {
        try{
            $description = $this->dom->filter('.article .article__body');
            return $description->html();
        } catch (\InvalidArgumentException $e){
            return  '';
        }

    }

    /**
     * @return string
     */
    public function imageUri()
    {
        try{
            $image = $this->dom->filter('.article__image--main img');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            return  'https://via.placeholder.com/728x320.png';
        }

    }

}
