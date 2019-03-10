<?php
namespace Playground;

class Downloader
{
    private $parser;
    private $url;
    private $startTime;
    private $endTime;

    public function __construct(\PHPHtmlParser\Dom $parser, string $url)
    {
        $this->url = $url;
        $this->parser = $parser;
    }

    public function loadSiteHTML() : void
    {
        $this->parser->loadFromUrl($this->url);
    }

    public function makeDownload(DownloadStrategy $download) : void
    {
        $this->startCountTime();
        $download->make($this->parser);
        $this->endCountTime();
    }

    private function startCountTime()
    {
        $this->startTime = microtime(true);
    }

    private function endCountTime()
    {
        $this->endTime = microtime(true);
    }

    public function getTotalExecutionTime()
    {
        return $this->endTime - $this->startTime;
    }
}
