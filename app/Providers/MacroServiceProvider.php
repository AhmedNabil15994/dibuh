<?php

namespace App\Providers;


use Collective\Html\HtmlServiceProvider;

/**
 * Class MacroServiceProvider
 * @package App\Providers
 */
class MacroServiceProvider extends HtmlServiceProvider {

    public function register() {
        parent::register();

        \Form::macro('select2', function($name, $list = [], $selected = null, $options = [], $disabled = []) {
            $html = '<select name="' . $name . '"';
            foreach ($options as $attribute => $value) {
                $html .= ' ' . $attribute . '="' . $value . '"';
            }
            $html .= '">';
            foreach ($list as $value => $text) {
                $html .= '<option value="' . $value . '"' .
                        ($value == $selected ? ' selected="selected"' : '') .
                        (in_array($value, $disabled) ? 'style="background:#5FBEAA;color:white;" disabled="disabled"  ' : '') . ' >' .
                        $text . '</option>';
            }
            $html .= '</select>';
            return $html;
        });
    }

}
