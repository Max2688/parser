<?php
namespace App\Http\Service\Parser\ParsersRbc;

use App\Http\Service\Parser\IParser;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;
class RBCParser implements IParser
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
            Log::info($e->getMessage());
            return '';
        }

    }

    public function description()
    {
        // TODO: Implement description() method.
        try{
            $description = $this->dom->filter('.article .article__text');
            return $description->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return '';
        }

    }

    public function imageUri()
    {
        // TODO: Implement image() method.
        try{
            $image = $this->dom->filter('.article__main-image__image');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return 'https://via.placeholder.com/728x320.png';
        }

    }
}