<?php

/**
 * Menu Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#navbar-default
 */
namespace LosUi\View\Helper\Navigation;

use RecursiveIteratorIterator;
use Zend\View\Helper\Navigation\Menu as ZendMenu;
use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\AbstractPage;
use Zend\View;
use LosUi\Navigation\Page\Divider;

/**
 * Menu Navigation view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/components/#navbar-default
 * @codeCoverageIgnore
 */
class Menu extends ZendMenu
{
    protected $ulClass = 'nav navbar-nav';

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\View\Helper\Navigation\Menu::renderDeepestMenu()
     */
    protected function renderDeepestMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $escapeLabels, $addClassToListItem, $liActiveClass = null)
    {
        if (!$active = $this->findActive($container, $minDepth - 1, $maxDepth)) {
            return '';
        }

        if ($active['depth'] < $minDepth) {
            if (!$active['page']->hasPages()) {
                return '';
            }
        } elseif (!$active['page']->hasPages()) {
            $active['page'] = $active['page']->getParent();
        } elseif (is_int($maxDepth) && $active['depth'] + 1 > $maxDepth) {
            $active['page'] = $active['page']->getParent();
        }

        $ulClass = $ulClass ? ' class="'.$ulClass.'"' : '';
        $html = $indent.'<ul'.$ulClass.'>'.PHP_EOL;

        foreach ($active['page'] as $subPage) {
            if (!$this->accept($subPage)) {
                continue;
            }

            $liClasses = [];
            if ($subPage->isActive(true)) {
                $liClasses[] = 'active';
            }

            if ($addClassToListItem && $subPage->getClass()) {
                $liClasses[] = $subPage->getClass();
            }
            $liClass = empty($liClasses) ? '' : ' class="'.implode(' ', $liClasses).'"';

            $html .= $indent.'    <li'.$liClass.'>'.PHP_EOL;
            $html .= $indent.'        '.$this->htmlify($subPage, $escapeLabels, $addClassToListItem).PHP_EOL;
            $html .= $indent.'    </li>'.PHP_EOL;
        }

        $html .= $indent.'</ul>';

        return $html;
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\View\Helper\Navigation\Menu::renderNormalMenu()
     */
    protected function renderNormalMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $onlyActive, $escapeLabels, $addClassToListItem, $liActiveClass = null)
    {
        $html = '';

        $found = $this->findActive($container, $minDepth, $maxDepth);
        if (!empty($found)) {
            $foundPage = $found['page'];
            $foundDepth = $found['depth'];
        } else {
            $foundPage = null;
            $foundDepth = 0;
        }

        // Since bootstrap doesn't support more than one level, we set maxDepth to minDeph plus one
        $maxDepth = $minDepth + 1;

        $iterator = new RecursiveIteratorIterator($container, RecursiveIteratorIterator::SELF_FIRST);
        if (is_int($maxDepth)) {
            $iterator->setMaxDepth($maxDepth);
        }

        $prevDepth = -1;
        foreach ($iterator as $page) {
            $depth = $iterator->getDepth();
            $isActive = $page->isActive(true);
            if ($depth < $minDepth || !$this->accept($page)) {
                continue;
            } elseif ($onlyActive && !$isActive) {
                $accept = false;
                if ($foundPage) {
                    if ($foundPage->hasPage($page)) {
                        $accept = true;
                    } elseif ($foundPage->getParent()->hasPage($page)) {
                        if (!$foundPage->hasPages() || is_int($maxDepth) && $foundDepth + 1 > $maxDepth) {
                            $accept = true;
                        }
                    }
                }

                if (!$accept) {
                    continue;
                }
            }

            $depth -= $minDepth;
            $myIndent = $indent.str_repeat('        ', $depth);

            if ($depth > $prevDepth) {
                if ($ulClass && $depth == 0) {
                    $ulClass = ' class="'.$ulClass.'"';
                } elseif ($page->getParent()) {
                    $ulClass = ' class="dropdown-menu"';
                } else {
                    $ulClass = '';
                }
                $html .= $myIndent.'<ul'.$ulClass.'>'.PHP_EOL;
            } elseif ($prevDepth > $depth) {
                for ($i = $prevDepth; $i > $depth; --$i) {
                    $ind = $indent.str_repeat('        ', $i);
                    $html .= $ind.'    </li>'.PHP_EOL;
                    $html .= $ind.'</ul>'.PHP_EOL;
                }
                $html .= $myIndent.'    </li>'.PHP_EOL;
            } else {
                $html .= $myIndent.'    </li>'.PHP_EOL;
            }

            $liClasses = [];
            if ($isActive) {
                $liClasses[] = 'active';
            }

            if ($page->hasPages() && (!isset($maxDepth) || $depth < $maxDepth)) {
                if (!isset($page->dropdown) || $page->dropdown === true) {
                    $liClasses[] = 'dropdown';
                    $page->isDropdown = true;
                }
            }

            if ($addClassToListItem && $page->getClass()) {
                $liClasses[] = $page->getClass();
            }
            $liClass = empty($liClasses) ? '' : ' class="'.implode(' ', $liClasses).'"';

            $html .= $myIndent.'    <li'.$liClass.'>'.PHP_EOL.$myIndent.'        '.$this->htmlify($page, $escapeLabels, $addClassToListItem).PHP_EOL;

            $prevDepth = $depth;
        }

        if ($html) {
            for ($i = $prevDepth + 1; $i > 0; --$i) {
                $myIndent = $indent.str_repeat('        ', $i - 1);
                $html .= $myIndent.'    </li>'.PHP_EOL.$myIndent.'</ul>'.PHP_EOL;
            }
            $html = rtrim($html, PHP_EOL);
        }

        return $html;
    }

    /**
     * (non-PHPdoc).
     *
     * @see \Zend\View\Helper\Navigation\Menu::htmlify()
     */
    public function htmlify(AbstractPage $page, $escapeLabel = true, $addClassToListItem = false)
    {
        if ($page instanceof Divider) {
            return '<li class="divider"></li>';
        }

        $label = $page->getLabel();
        $title = $page->getTitle();

        if (null !== ($translator = $this->getTranslator())) {
            $textDomain = $this->getTranslatorTextDomain();
            if (is_string($label) && !empty($label)) {
                $label = $translator->translate($label, $textDomain);
            }
            if (is_string($title) && !empty($title)) {
                $title = $translator->translate($title, $textDomain);
            }
        }

        $element = 'a';
        $extended = '';
        $attribs = [
            'id' => $page->getId(),
            'title' => $title,
            'href' => '#',
        ];

        $class = [];
        if ($addClassToListItem === false) {
            $class[] = $page->getClass();
        }
        if ($page->isDropdown) {
            $attribs['data-toggle'] = 'dropdown';
            $class[] = 'dropdown-toggle';
            $extended = ' <b class="caret"></b>';
        }
        if (count($class) > 0) {
            $attribs['class'] = implode(' ', $class);
        }

        $href = $page->getHref();
        if ($href) {
            $attribs['href'] = $href;
            $attribs['target'] = $page->getTarget();
        }

        $html = '<'.$element.$this->htmlAttribs($attribs).'>';
        if ($escapeLabel === true) {
            $escaper = $this->view->plugin('escapeHtml');
            $html .= $escaper($label);
        } else {
            $html .= $label;
        }

        $html .= $extended;
        $html .= '</'.$element.'>';

        return $html;
    }
}
