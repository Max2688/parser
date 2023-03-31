<?php
namespace App\Service\Parser;

abstract class ParserFactory
{
    abstract public function getParser(): IParser;
}
