<?php
namespace LosUi\View\Helper;

use Zend\View\Helper\HeadScript as ZfHeadScript;

/**
 * Helper for setting and retrieving script elements for HTML head section
 *
 * Allows the following method calls:
 *
 * @method HeadScript appendBootstrap($useMinified = true)
 * @method HeadScript prependBootstrap($useMinified = true)
 * @method HeadScript appendJquery($useMinified = true)
 * @method HeadScript prependJquery($useMinified = true)
 * @method HeadScript appendChosen($useMinified = true)
 * @method HeadScript prependChosen($useMinified = true)
 *
 * @method HeadScript appendFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript offsetSetFile($index, $src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript prependFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript setFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript appendScript($script, $type = 'text/javascript', $attrs = array())
 * @method HeadScript offsetSetScript($index, $src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript prependScript($script, $type = 'text/javascript', $attrs = array())
 * @method HeadScript setScript($script, $type = 'text/javascript', $attrs = array())
 */
class HeadScript extends ZfHeadScript
{

    /**
     * Overload method access
     *
     * @param  string                           $method
     *                                                  Method to call
     * @param  array                            $args
     *                                                  Arguments of method
     * @throws Exception\BadMethodCallException if too few arguments or invalid method
     * @return HeadScript
     */
    public function __call($method, $args)
    {
        if (preg_match('/^(?P<action>(ap|pre)pend)(?P<mode>Bootstrap|Jquery|Chosen)$/', $method, $matches)) {
            $action = $matches['action'];
            $mode = $matches['mode'];
            $type = 'text/javascript';
            $attrs = array();

            $action .= "File";

            $isMin = true;
            if (isset($args[0]) && is_bool($args[0])) {
                $isMin = $args[0];
            }

            switch ($mode) {
                case 'Bootstrap':
                    return $this->$action(sprintf('/bootstrap/dist/js/bootstrap.%sjs', $isMin ? 'min.' : ''));
                case 'Jquery':
                    return $this->$action(sprintf('/jquery/dist/jquery.%sjs', $isMin ? 'min.' : ''));
                case 'Chosen':
                    return $this->$action(sprintf('/chosen/chosen.jquery.%sjs', $isMin ? 'min.' : ''));
            }
        }

        return parent::__call($method, $args);
    }
}
