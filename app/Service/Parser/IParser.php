<?php
namespace App\Service\Parser;

interface IParser
{
    /**
     * @return string
     */
    public function title(): string;

    /**
     * @return string
     */
    public function description(): string;

    /**
     * @return string
     */
    public function imageUri(): string;
}
