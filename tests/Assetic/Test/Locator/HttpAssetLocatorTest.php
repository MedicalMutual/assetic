<?php

/*
 * This file is part of the Assetic package, an OpenSky project.
 *
 * (c) 2010-2011 OpenSky Project Inc
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Assetic\Test\Locator;

use Assetic\Locator\HttpAssetLocator;

class HttpAssetLocatorTest extends \PHPUnit_Framework_TestCase
{
    private $locator;

    protected function setUp()
    {
        $this->locator = new HttpAssetLocator();
    }

    public function getHttpUrls()
    {
        return array(
            array('http://example.com/foo.css'),
            array('https://example.com/foo.css'),
            array('//example.com/foo.css'),
        );
    }

    /**
     * @dataProvider getHttpUrls
     */
    public function testCorrectInput($sourceUrl)
    {
        $asset = $this->locator->locate($sourceUrl, array('vars' => array()));

        $this->assertNotNull($asset);
        $this->assertInstanceOf('Assetic\\Asset\\HttpAsset', $asset, '->locate() creates proper asset');
    }

    public function testWrongInput()
    {
        $asset = $this->locator->locate('example.com/foo.css');

        $this->assertNull($asset);
    }
}