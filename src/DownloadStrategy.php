<?php
namespace Playground;

interface DownloadStrategy
{
    public function make(\PHPHtmlParser\Dom $parser) : void ;
}
