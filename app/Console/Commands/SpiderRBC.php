<?php

namespace App\Console\Commands;

use App\Post;
use App\Service\FileService;
use App\Service\Parser\IParser;
use App\Service\Parser\ParserService;
use Illuminate\Console\Command;

class SpiderRBC extends Command
{
    const BASE_URI = 'https://www.rbc.ru/';
    const NODE_SELECTOR = '.js-news-feed-list > a';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spider:rbc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse news from sidebar';

    private ParserService $parserService;

    private FileService $fileService;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        ParserService $parserService,
        FileService $fileService,
    ){
        parent::__construct();
        $this->parserService = $parserService;
        $this->fileService = $fileService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info(sprintf('Get content of main page: %s', self::BASE_URI));

        $html = $this->parserService->getHttpResponse(self::BASE_URI);
        $crawler = $this->parserService->getCrawler($html);
        $links = $this->parserService->getLinksFromNodeSelector($crawler, self::NODE_SELECTOR);

        foreach ($links as $link) {
            $this->info(sprintf('Parse content from: %s', $link));

            $parser = $this->parserService->getCurrentParser($link);
            $this->fileService->uploadImgFromUri(trim($parser->imageUri()));
            $this->createPost($parser);
        }

        return Command::SUCCESS;
    }

    private function createPost(IParser $parser)
    {
        $post = new Post();
        $post->title = trim($parser->title());
        $post->image = basename($parser->imageUri());
        $post->description = trim(strip_tags($parser->description(), '<p><a><span><ul><li>'));
        $post->save();
    }
}
