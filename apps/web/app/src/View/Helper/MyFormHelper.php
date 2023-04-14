<?php

namespace App\View\Helper;

use Cake\View\Helper\FormHelper;
use Cake\Datasource\ModelAwareTrait;

class MyFormHelper extends FormHelper
{
    use ModelAwareTrait;

    public function input($fieldName, array $options = [])
    {
        $options = array_merge([
            'type' => null,
            'label' => false,
            'error' => null,
            'required' => null,
            'options' => null,
            'templates' => [],
            'templateVars' => [],
            'labelOptions' => true,
            'isInvalid' => null
        ], $options);

        if (!is_null($options['isInvalid']) && $options['isInvalid']) {
            if (empty($options['class'])) {
                $options['class'] = ['is-invalid'];
            } else {
                if (is_array($options['class'])) {
                    $options['class'][] = 'is-invalid';
                } else {
                    $options['class'] = $options['class'] . ' is-invalid';
                }
            }
        }

        return parent::control($fieldName, $options);

    }

    /**
     * Tableから画像の推奨サイズを取得
     * @param  [type] $model     [description]
     * @param  [type] $column    [description]
     * @param string $prefix [description]
     * @param string $separator [description]
     * @param array $options [description]
     * @return [type]            [description]
     */
    public function getRecommendSize($model, $column, $options = [])
    {
        $this->modelFactory('Table', ['Cake\ORM\TableRegistry', 'get']);
        $this->loadModel($model);

        $options = array_merge([
            'prefix' => '',
            'separator' => ' x ',
            'before' => '',
            'after' => ''
        ], $options);
        extract($options);

        $strSize = '';

        if (!empty($this->{$model}->recommend_size_display)) {
            $config = $this->{$model}->recommend_size_display;
            $attaches = $this->{$model}->attaches['images'];

            if (array_key_exists($column, $config) && array_key_exists($column, $attaches)) {
                if ($config[$column] === true) {
                    if ($prefix == "") {
                        $strSize = "{$attaches[$column]['width']}{$separator}{$attaches[$column]['height']}";
                    } elseif (array_key_exists($prefix, $attaches[$column]['thumbnails'])) {
                        $tmp = $attaches[$column]['thumbnails'][$prefix];
                        $strSize = "{$tmp['width']}{$separator}{$tmp['height']}";
                    }
                } elseif (is_array($config[$column])) {
                    $strSize = "{$config[$column]['width']}{$separator}{$config[$column]['height']}";
                } elseif ($config[$column] !== false) {
                    $strSize = $config[$column];
                }
                $strSize = $before . $strSize . $after;
            }
        }
        return $strSize;
    }

    public function timer($col_name, $options = [])
    {
        $options = array_merge([
            'mode' => 'start',
            'end_col' => null
        ], $options);

        if (!empty($options['end_col'])) {
            $options['mode'] = 'period';
        }

        $htmls = [];
        $htmls[] = '<div class="input-group">';

        if ($options['mode'] == 'start' || $options['mode'] == 'period') {
            $htmls[] = '<div class="input-group-prepend">';
            $this->_dateTimeInput($htmls, $col_name, $options);
            $htmls[] = '</div>';
        }

        $htmls[] = '</div>';

        return implode("\n", $htmls);
    }

    private function _dateTimeInput(&$htmls, $col_name, $options)
    {
        $options = array_merge([
            'date_class' => 'datepicker form-control',
            'date_default' => date('Y-m-d'),
            'time_class' => 'form-control',
            'fixed_readonly' => false
        ], $options);

        if ($options['fixed_readonly']) {
            $options['date_class'] = 'form-control-plaintext';
            $options['time_class'] = 'form-control-plaintext';
        }

        extract($options);
        $readonly = $options['fixed_readonly'];

        $htmls[] = parent::input("_{$col_name}_date", [
            'type' => 'text',
            'class' => $date_class,
            'data-auto-date' => '1',
            'default' => $date_default,
            'style' => 'width: 140px;',
            'readonly'
        ]);

        // Set Time 掲載日
        // $htmls[] = parent::time("_{$col_name}_time", [
        //     'type' => 'time',
        //     'format' => 'H:i',
        //     'class' => $time_class,
        //     'readonly' => $readonly
        // ]);
    }


    public function radioEx(string $fieldName, iterable $options = [], array $attributes = []): string
    {
        foreach ($options as $k => $v) {
            if (!is_array($v)) {
                $options[$k] = [
                    'value' => $k,
                    'text' => $v,
                    'disabled' => false
                ];
            }
        }

        return $this->_radio($fieldName, $options, $attributes);
    }
    public function _radio(string $fieldName, iterable $options = [], array $attributes = []): string
    {
        $html = [];
        $post_value = $this->getView()->getRequest()->getData($fieldName);
        if (array_key_exists('value', $attributes)) {
            $post_value = $attributes['value'];
        }

        $defaultValue = '';
        if (array_key_exists('defaultValue', $options)) {
            $defaultValue = $options['defaultValue'];
        }

        if (array_key_exists('readonly', $attributes) && $attributes['readonly']) {
            foreach ($options as $k => $v) {
                if ($v['value'] != $post_value) {
                    $options[$k]['disabled'] = true;
                }
            }
        }
        foreach ($options as $k => $v) {
            $html[] = parent::radio($fieldName, [$v['value'] => $v['text']], [
                'value' => h($post_value),
                'separator' => '　',
                'escape' => false,
                'defaultValue' => $defaultValue, 'disabled' => $v['disabled'],
                'hiddenField' => false
            ]);
        }

        return implode("\n", $html);
    }
}