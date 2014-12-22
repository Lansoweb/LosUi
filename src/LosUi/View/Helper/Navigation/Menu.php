<?php
namespace LosUi\View\Helper\Navigation;

use RecursiveIteratorIterator;
use Zend\View\Helper\Navigation\Menu as ZendMenu;
use Zend\Navigation\AbstractContainer;
use Zend\Navigation\Page\AbstractPage;
use Zend\View;
use Zend\View\Exception;
use LosUi\Navigation\Page\Divider;

class Menu extends ZendMenu
{

    protected $ulClass = 'nav navbar-nav';

    protected function renderDeepestMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $escapeLabels, $addClassToListItem, $liActiveClass = null)
    {
        if (! $active = $this->findActive($container, $minDepth - 1, $maxDepth)) {
            return '';
        }
        
        if ($active['depth'] < $minDepth) {
            if (! $active['page']->hasPages()) {
                return '';
            }
        } elseif (! $active['page']->hasPages()) {
            $active['page'] = $active['page']->getParent();
        } elseif (is_int($maxDepth) && $active['depth'] + 1 > $maxDepth) {
            $active['page'] = $active['page']->getParent();
        }
        
        $ulClass = $ulClass ? ' class="' . $ulClass . '"' : '';
        $html = $indent . '<ul' . $ulClass . '>' . self::EOL;
        
        foreach ($active['page'] as $subPage) {
            if (! $this->accept($subPage)) {
                continue;
            }
            
            $liClasses = array();
            if ($subPage->isActive(true)) {
                $liClasses[] = 'active';
            }
            
            if ($addClassToListItem && $subPage->getClass()) {
                $liClasses[] = $subPage->getClass();
            }
            $liClass = empty($liClasses) ? '' : ' class="' . implode(' ', $liClasses) . '"';
            
            $html .= $indent . '    <li' . $liClass . '>' . self::EOL;
            $html .= $indent . '        ' . $this->htmlify($subPage, $escapeLabels, $addClassToListItem) . self::EOL;
            $html .= $indent . '    </li>' . self::EOL;
        }
        
        $html .= $indent . '</ul>';
        
        return $html;
    }

    protected function renderNormalMenu(AbstractContainer $container, $ulClass, $indent, $minDepth, $maxDepth, $onlyActive, $escapeLabels, $addClassToListItem, $liActiveClass = null)
    {
        $html = '';
        
        $found = $this->findActive($container, $minDepth, $maxDepth);
        if ($found) {
            $foundPage = $found['page'];
            $foundDepth = $found['depth'];
        } else {
            $foundPage = null;
        }
        
        // Since bootstrap doesn't support more than one level, we set maxDepth to minDeph plus one
        $maxDepth = $minDepth + 1;
        
        $iterator = new RecursiveIteratorIterator($container, RecursiveIteratorIterator::SELF_FIRST);
        if (is_int($maxDepth)) {
            $iterator->setMaxDepth($maxDepth);
        }
        
        $prevDepth = - 1;
        foreach ($iterator as $page) {
            $depth = $iterator->getDepth();
            $isActive = $page->isActive(true);
            if ($depth < $minDepth || ! $this->accept($page)) {
                continue;
            } elseif ($onlyActive && ! $isActive) {
                $accept = false;
                if ($foundPage) {
                    if ($foundPage->hasPage($page)) {
                        $accept = true;
                    } elseif ($foundPage->getParent()->hasPage($page)) {
                        if (! $foundPage->hasPages() || is_int($maxDepth) && $foundDepth + 1 > $maxDepth) {
                            $accept = true;
                        }
                    }
                }
                
                if (! $accept) {
                    continue;
                }
            }
            
            $depth -= $minDepth;
            $myIndent = $indent . str_repeat('        ', $depth);
            
            if ($depth > $prevDepth) {
                if ($ulClass && $depth == 0) {
                    $ulClass = ' class="' . $ulClass . '"';
                } elseif ($page->getParent()) {
                    $ulClass = ' class="dropdown-menu"';
                } else {
                    $ulClass = '';
                }
                $html .= $myIndent . '<ul' . $ulClass . '>' . self::EOL;
            } elseif ($prevDepth > $depth) {
                for ($i = $prevDepth; $i > $depth; $i --) {
                    $ind = $indent . str_repeat('        ', $i);
                    $html .= $ind . '    </li>' . self::EOL;
                    $html .= $ind . '</ul>' . self::EOL;
                }
                $html .= $myIndent . '    </li>' . self::EOL;
            } else {
                $html .= $myIndent . '    </li>' . self::EOL;
            }
            
            $liClasses = array();
            if ($isActive) {
                $liClasses[] = 'active';
            }

            if ($page->hasChildren() && (! isset($maxDepth) || $depth < $maxDepth)) {
                if (! isset($page->dropdown) || $page->dropdown == true) {
                    $liClasses[] = 'dropdown';
                    $page->isDropdown = true;
                }
            }

            if ($addClassToListItem && $page->getClass()) {
                $liClasses[] = $page->getClass();
            }
            $liClass = empty($liClasses) ? '' : ' class="' . implode(' ', $liClasses) . '"';
            
            $html .= $myIndent . '    <li' . $liClass . '>' . self::EOL . $myIndent . '        ' . $this->htmlify($page, $escapeLabels, $addClassToListItem) . self::EOL;
            
            $prevDepth = $depth;
        }
        
        if ($html) {
            for ($i = $prevDepth + 1; $i > 0; $i --) {
                $myIndent = $indent . str_repeat('        ', $i - 1);
                $html .= $myIndent . '    </li>' . self::EOL . $myIndent . '</ul>' . self::EOL;
            }
            $html = rtrim($html, self::EOL);
        }
        
        return $html;
    }

    public function htmlify(AbstractPage $page, $escapeLabel = true, $addClassToListItem = false)
    {
        if ($page instanceof Divider) {
            return '<li class="divider"></li>';
        }

        $label = $page->getLabel();
        $title = $page->getTitle();
        
        if (null !== ($translator = $this->getTranslator())) {
            $textDomain = $this->getTranslatorTextDomain();
            if (is_string($label) && ! empty($label)) {
                $label = $translator->translate($label, $textDomain);
            }
            if (is_string($title) && ! empty($title)) {
                $title = $translator->translate($title, $textDomain);
            }
        }
        
        $element = 'a';
        $extended = '';
        $attribs = array(
            'id' => $page->getId(),
            'title' => $title,
            'href' => '#'
        );
        
        $class = array();
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
        
        $html = '<' . $element . $this->htmlAttribs($attribs) . '>';
        if ($escapeLabel === true) {
            $escaper = $this->view->plugin('escapeHtml');
            $html .= $escaper($label);
        } else {
            $html .= $label;
        }
        
        $html .= $extended;
        $html .= '</' . $element . '>';
        
        return $html;
    }
}