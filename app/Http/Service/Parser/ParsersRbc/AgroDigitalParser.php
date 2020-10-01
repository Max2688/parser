<?php
namespace App\Http\Service\Parser\ParsersRbc;

use App\Http\Service\Parser\IParser;
use Symfony\Component\DomCrawler\Crawler;

class AgroDigitalParser implements IParser
{
    private $dom;

    public function __construct(Crawler $dom)
    {
        $this->dom = $dom;
    }

    public function title()
    {
        // TODO: Implement title() method.
        try{
            $title = $this->dom->filter('.article__header .article__header__title .js-slide-title');
            return $title->html();
        } catch (\InvalidArgumentException $e){
            return  '';
        }

    }

    public function description()
    {
        // TODO: Implement description() method.
        try{
            $description = $this->dom->filter('.article .article__body');
            return $description->html();
        } catch (\InvalidArgumentException $e){
            return  '';
        }

    }

    public function imageUri()
    {
        // TODO: Implement image() method.
        try{
            $image = $this->dom->filter('.article__image--main img');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            return  'https://via.placeholder.com/728x320.png';
        }

    }

}