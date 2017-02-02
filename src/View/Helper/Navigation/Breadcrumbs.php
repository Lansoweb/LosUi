<?php

/**
 * Breadcrumbs Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#breadcrumbs
 */
namespace LosUi\View\Helper\Navigation;

use Zend\Navigation\Page\AbstractPage;
use Zend\View\Helper\Navigation\Breadcrumbs as ZendBreadcrumbs;
use Zend\Navigation\Page\Uri;

/**
 * Breadcrumbs Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#breadcrumbs
 * @codeCoverageIgnore
 */
class Breadcrumbs extends ZendBreadcrumbs
{
    /**
     * Setting default minDepth to 0.
     *
     * @var int
     */
    protected $minDepth = 0;

    /**
     * Bootstrap breadcrumbs already sets a separator.
     */
    protected $separator = '';

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\View\Helper\Navigation\AbstractHelper::htmlify()
     */
    public function htmlify(AbstractPage $page, $hasParent = false)
    {
        $html = '<li';
        if (!$hasParent) {
            $html .= ' class="active"';
        }
        $html .= '>';

        $label = $page->getLabel();
        if (null !== ($translator = $this->getTranslator())) {
            $label = $translator->translate($label, $this->getTranslatorTextDomain());
        }
        $escaper = $this->view->plugin('escapeHtml');
        $label = $escaper($label);

        if ($page->getHref() && ($hasParent || (!$hasParent && $this->getLinkLast())) &&
            (!($page instanceof Uri) || $page->getUri() != '#')) {
            $anchorAttribs = $this->htmlAttribs(['href' => $page->getHref()]);
            $html .= '<a'.$anchorAttribs.'>'.$label.'</a>';
        } else {
            $html .= $label;
        }

        $html .= '</li>';

        return $html;
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\View\Helper\Navigation\Breadcrumbs::renderStraight()
     */
    public function renderStraight($container = null)
    {
        $this->parseContainer($container);
        if (null === $container) {
            $container = $this->getContainer();
        }

        if (!$active = $this->findActive($container)) {
            return '';
        }

        $active = $active['page'];
        $html = $this->htmlify($active);

        while ($parent = $active->getParent()) {
            if ($parent instanceof AbstractPage) {
                $html = $this->htmlify($parent, true).$html;
            }

            if ($parent === $container) {
                break;
            }

            $active = $parent;
        }

        return strlen($html) ? '<ol class="breadcrumb">'.$this->getIndent().$html.'</ol>' : '';
    }
}
