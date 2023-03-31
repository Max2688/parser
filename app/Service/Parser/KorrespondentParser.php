<?php
namespace App\Service\Parser;

use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class KorrespondentParser implements IParser
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
            $title = $this->dom->filter('.post-item__title');
            return $title->html();
        } catch (\InvalidArgumentException $e){
            Log::info($e->getMessage());
            return '';
        }
    }

    /**
     * @return string
     */
    public function description()
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
     * @return string
     */
    public function imageUri()
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
