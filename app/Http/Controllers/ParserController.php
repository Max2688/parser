<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Service\Parser\ParserManager;

class ParserController extends Controller
{
    public function initParser(){

        $parser = new ParserManager('https://www.rbc.ru/', '.js-news-feed-list > a');
        $parser->init();
    }
}
