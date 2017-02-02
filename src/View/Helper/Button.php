<?php

/**
 * Button view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#buttons
 */
namespace LosUi\View\Helper;

use Zend\Form\View\Helper\AbstractHelper;

/**
 * Button view helper styled for Bootstrap 3.
 *
 * @author     Leandro Silva <leandro@leandrosilva.info>
 *
 * @category   LosUi
 *
 * @license    https://github.com/Lansoweb/LosUi/blob/master/LICENSE BSD-3 License
 *
 * @link       http://github.com/LansoWeb/LosUi
 * @link       http://getbootstrap.com/css/#buttons
 */
class Button extends AbstractHelper
{
    const TYPE_BUTTON = 0;

    const TYPE_ANCHOR = 1;

    const TYPE_INPUT = 2;

    protected $formatButton = '<button type="button" class="btn %s"%s>%s</button>';

    protected $formatAnchor = '<a href="%s" role="button" class="btn %s"%s>%s</a>';

    protected $formatInput = '<input type="%s" value="%s" class="btn %s"%s>';

    protected $type = self::TYPE_BUTTON;

    protected $value = null;

    protected $size = null;

    protected $isBlock = false;

    protected $isActive = false;

    protected $isDisabled = false;

    protected $anchor = '#';

    protected $anchorTarget = null;

    protected $inputType = 'button';

    protected $id = null;

    protected $name = null;

    public function asAnchor($anchor = '#', $target = null)
    {
        $this->type = self::TYPE_ANCHOR;
        $this->anchor = $anchor;
        $this->anchorTarget = $target;

        return $this;
    }

    public function asInput($type = 'button')
    {
        if ($type != 'button' && $type != 'submit' && $type != 'reset') {
            throw new \InvalidArgumentException('Input type must be "button", "submit" or "reset"');
        }
        $this->type = self::TYPE_INPUT;
        $this->inputType = $type;

        return $this;
    }

    public function asButton()
    {
        $this->type = self::TYPE_BUTTON;

        return $this;
    }

    /* Color methods */
    public function useDefault($value, $style = null)
    {
        return $this->render($value, 'btn-default', $style);
    }

    public function primary($value, $style = null)
    {
        return $this->render($value, 'btn-primary', $style);
    }

    public function success($value, $style = null)
    {
        return $this->render($value, 'btn-success', $style);
    }

    public function info($value, $style = null)
    {
        return $this->render($value, 'btn-info', $style);
    }

    public function warning($value, $style = null)
    {
        return $this->render($value, 'btn-warning', $style);
    }

    public function danger($value, $style = null)
    {
        return $this->render($value, 'btn-danger', $style);
    }

    public function link($value, $style = null)
    {
        return $this->render($value, 'btn-link', $style);
    }

    /* Size methods */
    public function setLarge()
    {
        $this->size = 'btn-lg';

        return $this;
    }

    public function setSmall()
    {
        $this->size = 'btn-sm';

        return $this;
    }

    public function setExtraSmall()
    {
        $this->size = 'btn-xs';

        return $this;
    }

    /* Block method */
    public function isBlock($block = true)
    {
        if (!is_bool($block)) {
            $block = false;
        }
        $this->isBlock = $block;

        return $this;
    }

    /* Active method */
    public function isActive($active = true)
    {
        if (!is_bool($active)) {
            $active = false;
        }
        $this->isActive = $active;

        return $this;
    }

    /* Disabled method */
    public function isDisabled($disabled = true)
    {
        if (!is_bool($disabled)) {
            $disabled = false;
        }
        $this->isDisabled = $disabled;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /* default methods */
    public function render($value, $class = 'btn-default', $style = null)
    {
        $class = trim($class);

        $extra = '';
        if ($this->isDisabled) {
            $extra .= ' disabled="disabled"';
        }
        if ($this->id !== null) {
            $extra .= ' id="'.$this->id.'"';
        }
        if ($this->name !== null) {
            $extra .= ' name="'.$this->name.'"';
        }
        if ($style !== null) {
            $extra .= ' style="'.$style.'"';
        }

        if ($this->isActive) {
            $class .= ' active';
        }
        if ($this->isBlock) {
            $class .= ' btn-block';
        }
        if ($this->size !== null) {
            $class .= ' '.$this->size;
        }

        if ($this->type == self::TYPE_ANCHOR) {
            if ($this->anchorTarget !== null) {
                $extra .= ' target="'.$this->anchorTarget.'"';
            }

            return sprintf($this->formatAnchor, $this->anchor, $class, $extra, $value);
        } elseif ($this->type == self::TYPE_INPUT) {
            return sprintf($this->formatInput, $this->inputType, $value, $class, $extra);
        } else {
            return sprintf($this->formatButton, $class, $extra, $value);
        }
    }

    public function __invoke($value = null, $class = 'default', $style = null)
    {
        if ($value) {
            return $this->render($value, "btn-$class", $style);
        }

        return $this;
    }
}
