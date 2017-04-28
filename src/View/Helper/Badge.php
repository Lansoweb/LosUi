<?php

/**
 * Badge view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/Lansoweb/LosUi
 * @link       http://getbootstrap.com/components/#badges
 */
namespace LosUi\View\Helper;

/**
 * Badge view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE MIT License
 *
 * @link       http://github.com/Lansoweb/LosUi
 * @link       http://getbootstrap.com/components/#badges
 */
class Badge
{
    protected $format = '<span class="badge">%s</span>';

    public function render($badge)
    {
        return sprintf($this->format, $badge);
    }

    public function __invoke($badge = null)
    {
        if ($badge) {
            return $this->render($badge);
        }

        return $this;
    }
}
