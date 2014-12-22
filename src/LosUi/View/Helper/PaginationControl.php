<?php
namespace LosUi\View\Helper;

use Zend\View\Helper\PaginationControl as ZfPaginationControl;
use Zend\Paginator;

class PaginationControl extends ZfPaginationControl
{
    protected static $defaultViewPartial = 'paginator/control.phtml';
    protected static $nextLabel = 'Next &rarr;';
    protected static $previousLabel = '&larr; Previous';
    
    public function __invoke(Paginator\Paginator $paginator = null, $scrollingStyle = null, $partial = null, $params = null)
    {
        if (is_string($params)) {
            $params = (array)$params;
        }
        
        if (isset($params['size'])) {
            if ($params['size'] != 'sm' && $params['size'] != 'lg') {
                throw new \RuntimeException('Size parameter must be either "sm" or "lg"');
            }
        }
        if ($partial == null && isset($params['type'])) {
            if ($params['type'] == 'pager') {
                $partial = 'paginator/pager.phtml';
            }
        }
        if (!isset($params['aligned']) || !is_bool($params['aligned'])) {
            $params['aligned'] = true;
        }
        if (!isset($params['nextLabel'])) {
            $params['nextLabel'] = self::$nextLabel;
        }
        if (!isset($params['previousLabel'])) {
            $params['previousLabel'] = self::$previousLabel;
        }
        return parent::__invoke($paginator, $scrollingStyle, $partial, $params);
    }
}