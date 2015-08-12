<?php

/**
 * Url view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Stdlib\RequestInterface;

/**
 * Url view helper.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 */
final class Url extends AbstractHelper
{
    private $request;

    public function from($name = null, $params = [], $options = [], $reuseMatchedParams = false)
    {
        if (3 == func_num_args() && is_bool($options)) {
            $reuseMatchedParams = $options;
            $options = [];
        }

        if ($reuseMatchedParams) {
            $queryParams = $this->request->getQuery();

            if (!empty($queryParams)) {
                $queryParams = $queryParams->toArray();
                if (array_key_exists('query', $options)) {
                    $options['query'] = array_merge($queryParams, $options['query']);
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
