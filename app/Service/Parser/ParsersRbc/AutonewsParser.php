<?php
namespace App\Service\Parser\ParsersRbc;

use App\Service\Parser\IParser;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class AutonewsParser implements IParser
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
            $title = $this->dom->filter('.article__header__title h1');
            return $title->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function description(): string
    {
        try{
            $description = $this->dom->filter('.article__text');
            return $description->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return '';
    }

    /**
     * @inheritDoc
     */
    public function imageUri(): string
    {
        try{
            $image = $this->dom->filter('.article__main-image__image img');
            return $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
        }

        return 'https://via.placeholder.com/728x320.png';
    }
}
