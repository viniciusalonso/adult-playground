<?php
namespace Playground;

class Downloader
{
    private $parser;
    private $url;
    private $directory;

    public function __construct(\PHPHtmlParser\Dom $parser, string $url, string $directory)
    {
        $this->url = $url;
        $this->parser = $parser;
        $this->directory = $directory;
    }

    public function loadSiteHTML() : void
    {
        $this->parser->loadFromUrl($this->url);
    }

    public function makeDownload() : void
    {
        $blocks = $this->parser->find('.thumb-block');
        foreach ($blocks as $block)
        {
            $videoName = $this->getVideoName($block);
            $imageSource = $this->getImageSourceFromThumbTag($block);
            $this->saveThumbInDirectory($videoName, $imageSource);
        }

    }

    private function getVideoName(\PHPHtmlParser\Dom\HtmlNode $block) : string
    {
        $link  = current($block->find('.thumb-under p a'));
        return $link->text;
    }

    private function getImageSourceFromThumbTag(\PHPHtmlParser\Dom\HtmlNode $tag) : string
    {
        return $tag->find('.thumb-inside img')[0]->getAttribute('data-src');
    }

    private function saveThumbInDirectory(string $videoName, string $imageSource) : void
    {
        $extension = pathinfo($imageSource, PATHINFO_EXTENSION);
        $file = file_get_contents($imageSource);
        file_put_contents("{$this->directory}/{$videoName}.{$extension}", $file);
    }
}
