<?php
namespace App\Http\Service\Parser;

abstract class ParserFactory
{
    abstract public function getParser(): IParser;
}