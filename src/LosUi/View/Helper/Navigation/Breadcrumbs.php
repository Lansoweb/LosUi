<?php

namespace LosUi\View\Helper\Navigation;

use Zend\Navigation\Page\AbstractPage;
use Zend\View\Helper\Navigation\Breadcrumbs as ZendBreadcrumbs;
use Zend\Navigation\Page\Uri;

class Breadcrumbs extends ZendBreadcrumbs
{
    protected $minDepth = 0;

    protected $separator = '';

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
            $anchorAttribs = $this->htmlAttribs(array('href' => $page->getHref()));
            $html .= '<a' . $anchorAttribs . '>' . $label . '</a>';
        } else {
            $html .= $label;
        }

        $html .= '</li>';
        return $html;
    }

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
                $html = $this->htmlify($parent, true) . $html;
            }

            if ($parent === $container) {
                break;
            }

            $active = $parent;
        }

        return strlen($html) ? '<ol class="breadcrumb">' . $this->getIndent() . $html . '</ol>' : '';
    }
}