<?php
namespace App\Http\Service\Parser;

interface IParser
{
    public function title();
    public function description();
    public function imageUri();
}