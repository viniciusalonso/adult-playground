<?php
namespace Playground;

class DownloadThumbsAtHome implements DownloadStrategy
{
    private $directory;

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function make(\PHPHtmlParser\Dom $parser) : void
    {
        $blocks = $parser->find('.thumb-block');
        foreach ($blocks as $block)
        {
            $videoName = $this->getVideoName($block);
            $imageSource = $this->getImageSourceFromThumbTag($block);
            $this->saveThumbInDirectory($videoName, $imageSource);
        }
    }

    private function getVideoName(\PHPHtmlParser\Dom\HtmlNode $block) : string
    {
        $link  = $block->find('.thumb-under p a')[0];
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
