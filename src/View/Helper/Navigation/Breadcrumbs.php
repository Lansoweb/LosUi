<?php

/**
 * Breadcrumbs Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#breadcrumbs
 */
namespace LosUi\View\Helper\Navigation;

use Laminas\Navigation\Page\AbstractPage;
use Laminas\View\Helper\Navigation\Breadcrumbs as ZendBreadcrumbs;
use Laminas\Navigation\Page\Uri;

/**
 * Breadcrumbs Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
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
     * @see \Laminas\View\Helper\Navigation\AbstractHelper::htmlify()
     * @param AbstractPage $page
     * @param bool $hasParent
     * @return string
     */
    public function htmlify(AbstractPage $page, $hasParent = false)
    {
        $html = '<li';
        if (! $hasParent) {
            $html .= ' class="active"';
        }
        $html .= '>';

        $label = $page->getLabel();
        if (null !== ($translator = $this->getTranslator())) {
            $label = $translator->translate($label, $this->getTranslatorTextDomain());
        }
        $escaper = $this->view->plugin('escapeHtml');
        $label = $escaper($label);

        if ($page->getHref() && ($hasParent || (! $hasParent && $this->getLinkLast())) &&
            (! ($page instanceof Uri) || $page->getUri() != '#')) {
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
     * @see \Laminas\View\Helper\Navigation\Breadcrumbs::renderStraight()
     * @param null $container
     * @return string
     */
    public function renderStraight($container = null)
    {
        $this->parseContainer($container);
        if (null === $container) {
            $container = $this->getContainer();
        }

        if (! $active = $this->findActive($container)) {
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
