<?php
namespace Tests;

use Playground\Downloader;
use PHPHtmlParser\Dom;

class DownloaderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     **/
    public function loadSiteHTML_shouldLoadHtmlFromUrl()
    {
        $domMock = $this->getMockBuilder(Dom::class)
            ->setMethods(['loadFromUrl'])
            ->getMock();

        $url = "http://www.example.com";

        $directory = "thumbs";

        $domMock->expects($this->once())
            ->method('loadFromUrl')
            ->with($this->equalTo($url));

        $downloader = new Downloader($domMock, $url, $directory);
        $downloader->loadSiteHTML();
    }

    /**
     * @test
     **/
    /* public function makeDownload_when() */
    /* { */
    /*     $domMock = $this->createMock(Dom::class); */
    /*     $domMock->method('loadFromUrl') */
    /*         ->willReturn($this->getHtmlFaker()); */

    /*     $url = "http://www.example.com"; */

    /*     $directory = "thumbs"; */

    /*     $downloader = new Downloader($domMock, $url, $directory); */
    /*     $downloader->loadSiteHTML(); */
    /*     $downloader->makeDownload(); */
    /* } */

    /* private function getHtmlFaker() */
    /* { */
    /*     return file_get_contents(__DIR__ . '/fixtures/block.html'); */
    /* } */

}
