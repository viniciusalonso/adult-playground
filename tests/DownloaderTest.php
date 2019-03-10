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

        $domMock->expects($this->once())
            ->method('loadFromUrl')
            ->with($this->equalTo($url));

        $downloader = new Downloader($domMock, $url);
        $downloader->loadSiteHTML();
    }

    /**
     * @test
     **/
    public function makeDownload_shouldApplyStrategyToDownload()
    {
        $domMock = $this->getMockBuilder(Dom::class)
            ->setMethods(['loadFromUrl'])
            ->getMock();

        $url = "http://www.example.com";

        $domMock->expects($this->once())
            ->method('loadFromUrl')
            ->with($this->equalTo($url));

        $strategy = $this->prophesize(\Playground\DownloadStrategy::class);
        $strategy->make($domMock)->shouldBeCalled();

        $downloader = new Downloader($domMock, $url);
        $downloader->loadSiteHTML();
        $downloader->makeDownload($strategy->reveal());
    }

}
