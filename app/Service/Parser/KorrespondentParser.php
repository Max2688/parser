<?php
namespace App\Service\Parser;

use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class KorrespondentParser implements IParser
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
            $title = $this->dom->filter('.post-item__title');
            return $title->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return '';
        }
    }

    /**
     * @inheritDoc
     */
    public function description(): string
    {
        try{
            $description = $this->dom->filter('.post-item__text');
            return $description->html();
        } catch(\InvalidArgumentException $e) {
            Log::info($e->getMessage());
            return '';
        }

    }

    /**
     * @inheritDoc
     */
    public function imageUri(): string
    {
        try{
            $image = $this->dom->filter('.post-item__big-photo-img');
            return  $image->image()->getUri();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return 'https://via.placeholder.com/728x320.png';
        }
    }
}
