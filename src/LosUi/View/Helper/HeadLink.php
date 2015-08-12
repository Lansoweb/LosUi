<?php

/**
 * Head Link view helper, adding the necessary libs or cdns.
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

use Zend\View\Helper\HeadLink as ZfHeadLink;

/**
 * Head Link view helper, adding the necessary libs or cdns.
 *
 * Allows the following method calls:
 *
 * @method HeadLink appendBootstrap($useMinified = true)
 * @method HeadLink prependBootstrap($useMinified = true)
 * @method HeadLink appendFontAwesome($useMinified = true)
 * @method HeadLink prependFontAwesome($useMinified = true)
 * @method HeadLink appendChosen($useMinified = true)
 * @method HeadLink prependChosen($useMinified = true)
 * @method HeadLink appendStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink offsetSetStylesheet($index, $href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink prependStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink setStylesheet($href, $media = 'screen', $conditionalStylesheet = '', $extras = array())
 * @method HeadLink appendAlternate($href, $type, $title, $extras = array())
 * @method HeadLink offsetSetAlternate($index, $href, $type, $title, $extras = array())
 * @method HeadLink prependAlternate($href, $type, $title, $extras = array())
 * @method HeadLink setAlternate($href, $type, $title, $extras = array())
 *
 * @author Leandro Silva <leandro@leandrosilva.info>
 *
 * @category LosUi
 *
 * @license https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link http://github.com/LansoWeb/LosUi
 */
class HeadLink extends ZfHeadLink
{
    const VERSION_BOOTSTRAP = '3.3.5';

    const VERSION_FONTAWESOME = '4.4.0';

    /**
     * @param array  $matches
     * @param string $basePath
     * @param array  $args
     */
    private function callWithCdn($matches, $basePath, $args)
    {
        $action = $matches['action'];
        $type = $matches['type'];

        $action .= 'Stylesheet';

        $useCdn = false;
        $version = false;
        $isMin = true;

        if (isset($args[0])) {
            if (is_bool($args[0])) {
                $useCdn = $args[0];
            } else {
                $version = $args[0];
            }
        }

        if (isset($args[1]) && is_bool($args[1])) {
            $isMin = $args[1];
        }

        if (isset($args[2])) {
            $version = $args[2];
        }

        switch ($type) {
            case 'Bootstrap':
                if ($useCdn) {
                    return $this->$action(sprintf('//maxcdn.bootstrapcdn.com/bootstrap/%s/css/bootstrap.%scss', $version ?: self::VERSION_BOOTSTRAP, $isMin ? 'min.' : ''));
                } else {
                    return $this->$action(sprintf('%s/bootstrap/dist/css/bootstrap.%scss', $basePath, $isMin ? 'min.' : ''));
                }
            case 'FontAwesome':
                if ($useCdn) {
                    return $this->$action(sprintf('//maxcdn.bootstrapcdn.com/font-awesome/%s/css/font-awesome.%scss', $version ?: self::VERSION_FONTAWESOME, $isMin ? 'min.' : ''));
                } else {
                    return $this->$action(sprintf('%s/fontawesome/css/font-awesome.%scss', $basePath, $isMin ? 'min.' : ''));
                }
        }

        return false;
    }

    /**
     * @param array  $matches
     * @param string $basePath
     * @param array  $args
     */
    private function callWithoutCdn($matches, $basePath, $args)
    {
        $action = $matches['action'];
        $type = $matches['type'];

        $action .= 'Stylesheet';

        $isMin = true;

        switch ($type) {
            case 'Chosen':
                return $this->$action(sprintf('%s/chosen/chosen.%scss', $basePath, $isMin ? 'min.' : ''));
            case 'ChosenBootstrap':
                return $this->$action(sprintf('%s/losui/chosenbs3.css', $basePath));
        }

        return false;
    }

    /**
     * Overload method access.
     *
     * @param mixed $method
     * @param mixed $args
     *
     * @throws Exception\BadMethodCallException
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        $basePath = '';
        if (method_exists($this->view, 'plugin')) {
            $basePath = $this->view->plugin('basepath')->__invoke();
        }

        $ret = false;

        if (preg_match('/^(?P<action>set|(ap|pre)pend)(?P<type>Bootstrap|FontAwesome)$/', $method, $matches)) {
            $ret = $this->callWithCdn($matches, $basePath, $args);
        } elseif (preg_match('/^(?P<action>set|(ap|pre)pend)(?P<type>Chosen|ChosenBootstrap)$/', $method, $matches)) {
            $ret = $this->callWithoutCdn($matches, $basePath, $args);
        }

        return ($ret !== false) ? $ret : parent::__call($method, $args);
    }
}
