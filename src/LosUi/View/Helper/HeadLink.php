<?php
namespace LosUi\View\Helper;

use Zend\View\Helper\HeadLink as ZfHeadLink;

/**
 * Allows the following method calls:
 *
 * @method HeadLink appendBootstrap($useMinified = true)
 * @method HeadLink prependBootstrap($useMinified = true)
 * @method HeadLink appendFontAwesome($useMinified = true)
 * @method HeadLink prependFontAwesome($useMinified = true)
 * @method HeadLink appendChosen($useMinified = true)
 * @method HeadLink prependChosen($useMinified = true)
 *
 * @method HeadLink appendStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink offsetSetStylesheet($index, $href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink prependStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink setStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink appendAlternate($href, $type, $title, $extras = array())
 * @method HeadLink offsetSetAlternate($index, $href, $type, $title, $extras = array())
 * @method HeadLink prependAlternate($href, $type, $title, $extras = array())
 * @method HeadLink setAlternate($href, $type, $title, $extras = array())
 */
class HeadLink extends ZfHeadLink
{

    /**
     * Overload method access
     *
     * @param  mixed                            $method
     * @param  mixed                            $args
     * @throws Exception\BadMethodCallException
     * @return void
     */
    public function __call($method, $args)
    {
        if (preg_match('/^(?P<action>set|(ap|pre)pend)(?P<type>Bootstrap|FontAwesome|Chosen)$/', $method, $matches)) {
            $argc = count($args);
            $action = $matches['action'];
            $type = $matches['type'];

            $action .= "Stylesheet";

            $isMin = true;
            if (isset($args[0]) && is_bool($args[0])) {
                $isMin = $args[0];
            }
            switch ($type) {
                case 'Bootstrap':
                    return $this->$action(sprintf('/bootstrap/dist/css/bootstrap.%scss', $isMin ? 'min.' : ''));
                case 'FontAwesome':
                    return $this->$action(sprintf('/fontawesome/css/font-awesome.%scss', $isMin ? 'min.' : ''));
                case 'Chosen':
                    return $this->$action(sprintf('/chosen/chosen.%scss', $isMin ? 'min.' : ''));
            }
        }

        return parent::__call($method, $args);
    }
}
