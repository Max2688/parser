<?php
namespace App\Http\Service\Parser\ParsersRbc;

use App\Http\Service\Parser\IParser;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class AutonewsParser implements IParser
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
            $title = $this->dom->filter('.article__header  .js-slide-title');
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
            $image = $this->dom->filter('.article__main-image__image img');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return 'https://via.placeholder.com/728x320.png';
        }

    }
}