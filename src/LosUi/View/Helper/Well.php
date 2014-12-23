<?php
/**
 * Well view helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#wells
 */
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Well view helper
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    http://opensource.org/licenses/MIT   MIT License
 * @link       http://github.com/LansoWeb/LosUi
 * @see        http://getbootstrap.com/components/#wells
 */
class Well extends AbstractHelper
{

    protected $format = '<div class="well%s">%s</div>';

    public function __invoke($content = '', $class = '')
    {
        if ($content) {
            return $this->render($content, $class);
        }

        return $this;
    }

    public function large($content)
    {
        return $this->render($content, 'well-lg');
    }

    public function small($content)
    {
        return $this->render($content, 'well-sm');
    }

    public function render($content, $class = '')
    {
        $class = ' ' . trim($class);

        return sprintf($this->format, $class, $content);
    }
}
