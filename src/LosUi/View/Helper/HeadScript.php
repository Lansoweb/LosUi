<?php
/**
 * Head Script view helper adding the necessary libs or cdns
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosUi
 */
namespace LosUi\View\Helper;

use Zend\View\Helper\HeadScript as ZfHeadScript;

/**
 * Head Script view helper adding the necessary libs or cdns
 *
 * Allows the following method calls:
 *
 * @method HeadScript appendBootstrap($useMinified = true)
 * @method HeadScript prependBootstrap($useMinified = true)
 * @method HeadScript appendJquery($useMinified = true)
 * @method HeadScript prependJquery($useMinified = true)
 * @method HeadScript appendChosen($useMinified = true)
 * @method HeadScript prependChosen($useMinified = true)
 * @method HeadScript appendMoment($useMinified = true)
 * @method HeadScript prependMoment($useMinified = true)
 *
 * @method HeadScript appendFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript offsetSetFile($index, $src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript prependFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript setFile($src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript appendScript($script, $type = 'text/javascript', $attrs = array())
 * @method HeadScript offsetSetScript($index, $src, $type = 'text/javascript', $attrs = array())
 * @method HeadScript prependScript($script, $type = 'text/javascript', $attrs = array())
 * @method HeadScript setScript($script, $type = 'text/javascript', $attrs = array())
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 * @category   LosUi
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 * @link       http://github.com/LansoWeb/LosUi
 */
class HeadScript extends ZfHeadScript
{

    const VERSION_JQUERY = "2.1.3";

    const VERSION_BOOTSTRAP = "3.3.2";

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
        if (preg_match('/^(?P<action>(ap|pre)pend)(?P<mode>Bootstrap|Jquery)$/', $method, $matches)) {
            $action = $matches['action'];
            $mode = $matches['mode'];
            $type = 'text/javascript';
            $attrs = array();

            $action .= "File";

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

            switch ($mode) {
                case 'Bootstrap':
                    if ($useCdn) {
                        return $this->$action(sprintf('//maxcdn.bootstrapcdn.com/bootstrap/%s/js/bootstrap.%sjs', $version ?  : self::VERSION_BOOTSTRAP, $isMin ? 'min.' : ''));
                    } else {
                        return $this->$action(sprintf('/bootstrap/dist/js/bootstrap.%sjs', $isMin ? 'min.' : ''));
                    }
                case 'Jquery':
                    if ($useCdn) {
                        return $this->$action(sprintf('//code.jquery.com/jquery-%s.%sjs', $version ?  : self::VERSION_JQUERY, $isMin ? 'min.' : ''));
                    } else {
                        return $this->$action(sprintf('/jquery/dist/jquery.%sjs', $isMin ? 'min.' : ''));
                    }
            }
        } else
            if (preg_match('/^(?P<action>(ap|pre)pend)(?P<mode>Chosen|Moment)$/', $method, $matches)) {
                $action = $matches['action'];
                $mode = $matches['mode'];
                $type = 'text/javascript';
                $attrs = array();

                $action .= "File";

                $langs = [];
                $isMin = true;

                if (isset($args[0])) {
                    if (is_bool($args[0])) {
                        $isMin = $args[0];
                    } else {
                        $langs = $args[0];
                    }
                }

                if (isset($args[1]) && is_bool($args[1])) {
                    $isMin = $args[1];
                }

                switch ($mode) {
                    case 'Chosen':
                        return $this->$action(sprintf('/chosen/chosen.jquery.%sjs', $isMin ? 'min.' : ''));

                    case 'Moment':
                        if (in_array('*', $langs)) {
                            $ret = $this->$action(sprintf('/moment/min/moment-with-locales.%sjs', $isMin ? 'min.' : ''));
                        } else {
                            $ret = $this->$action(sprintf('/moment/%smoment.%sjs', $isMin ? 'min/' : '', $isMin ? 'min.' : ''));
                            foreach ($langs as $lang) {
                                $ret = $ret->$action(sprintf('/moment/%slocale/%s.%sjs', $isMin ? 'min/' : '', $lang, $isMin ? 'min.' : ''));
                            }
                        }
                        return $ret;
                }
            }

        return parent::__call($method, $args);
    }
}
