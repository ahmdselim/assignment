<?php

class Form
{
    public static function openForm($class, $action, $method, $enctype)
    {
        return <<<TEXT
        <form class="$class" action="$action" method="$method" enctype="$enctype">
        TEXT;
    }

    public static function input($type, $class, $id,  $name, $value, $placeholder)
    {
        return <<<TEXT
        <input type="$type" class="$class" name="$name" value="$value" placeholder="$placeholder" />
        TEXT;
    }

    public static function closeForm()
    {
        return <<<TEXT
        </form>
        TEXT;
    }

    public static function textarea($class, $id, $name, $value, $placeholder)
    {
        return <<<TEXT
        <textarea class="$class" name="$name" placeholder="$placeholder">$value</textarea>
        TEXT;
    }
    public static function openSelect($name, $class, $id)
    {
        return <<<SELECT
        <select name="$name" class="$class" $id="$id">
        SELECT;
    }
    public static function closeSelect()
    {
        return <<<SELECT
        </select>
        SELECT;
    }
    // public static function option($values = [], $names = [], $class, $id)
    // {
    //     $countNames = count($names);
    //     $countValues = count($values);
    //     $options = [];

    //     if ($countNames !== $countValues) {
    //         return "number of names must equal number of count";
    //     }

    //     foreach ($values as $val) {
    //         $valuesVal[] = $val;
    //     }

    //     foreach ($names as $nameVal) {
    //         $namesVal[] = $nameVal;
    //     }
    //     $value = implode(" ", $valuesVal);
    //     $name = implode(" ", $namesVal);

    //     for ($i = 0; $i < $countNames; $i++) {
    //         global $options;

    //         $options[] =     <<<OPTION
    //         <option name="$name" class="$class" $id="$id">$value</option>
    //         OPTION;
    //     }
    //     return ($options);
    // }
    public static function button($class, $name, $id, $value)
    {
        return <<<TEXT
        <button class="$class" id="$id" name="$name">$value</button>
        TEXT;
    }

    public static function openDiv($class, $id, $dataAttrName, $dataAttrValue)
    {
        return <<<TEXT
        <div class="$class" id="$id" $dataAttrName="$dataAttrValue">
        TEXT;
    }
    public static function closeDiv()
    {
        return "</div>";
    }
    public static function h1($class, $id, $dataAttrName, $dataAttrValue, $value)
    {
        return <<<TEXT
        <h1 class="$class" id="$id" $dataAttrName="$dataAttrValue">$value</h1>
        TEXT;
    }
    public static function label($value, $for, $class, $id, $dataAttrName, $dataAttrValue)
    {
        return <<<TEXT
        <label for="$for" class="$class" id="$id" $dataAttrName="$dataAttrValue">$value</label>
        TEXT;
    }
}
