<?php

/**
 * Tests for Image View Helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#alerts
 */
namespace LosUiTest\View\Helper;

use LosUi\View\Helper\Image;
use Laminas\View\Renderer\PhpRenderer as View;

class ImageTest extends \PHPUnit_Framework_TestCase
{
    protected $helper;

    public function setUp()
    {
        $this->helper = new Image();
        $view = new View();
        $this->helper->setView($view);
        $basePath = $view->plugin('basePath');
        $basePath->setBasePath('/');
    }

    private function getExpected($img, $class = '', $responsive = true)
    {
        if ($responsive) {
            $class .= (!empty($class) ? ' ' : '').'img-responsive';
        }

        return '<img src="/'.$img.'" class="'.$class.'">';
    }

    public function testCircle()
    {
        $this->assertEquals($this->getExpected('foo.png', 'img-circle'), $this->helper->circle('foo.png'));
    }
    public function testRounded()
    {
        $this->assertEquals($this->getExpected('foo.png', 'img-rounded'), $this->helper->rounded('foo.png'));
    }
    public function testThumbnail()
    {
        $this->assertEquals($this->getExpected('foo.png', 'img-thumbnail'), $this->helper->thumbnail('foo.png'));
    }
    public function testCircleNotResponsive()
    {
        $this->assertEquals($this->getExpected('foo.png', 'img-circle', false), $this->helper->setResponsive(false)->circle('foo.png'));
    }

    public function testRender()
    {
        $this->assertEquals($this->getExpected('foo.png'), $this->helper->render('foo.png'));
    }

    public function testInvoke()
    {
        $this->assertEquals($this->getExpected('foo.png'), $this->helper->__invoke('foo.png'));
    }
}
