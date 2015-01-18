<?php
namespace LosUi\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Stdlib\RequestInterface;

class Url extends AbstractHelper
{

    protected $request;

    public function from($name = null, $params = array(), $options = array(), $reuseMatchedParams = false)
    {
        if (3 == func_num_args() && is_bool($options)) {
            $reuseMatchedParams = $options;
            $options = array();
        }

        if ($reuseMatchedParams) {
            $queryParams = $this->request->getQuery();

            if (! empty($queryParams)) {
                $queryParams = $queryParams->toArray();
                if (array_key_exists('query', $options)) {
                    $options['query'] = array_merge($options['query'], $queryParams);
                } else {
                    $options['query'] = $queryParams;
                }
            }
        }
        return $this->view->plugin('url')->__invoke($name, $params, $options, $reuseMatchedParams);
    }

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

}