<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $table = "options";

    private static $metaData = [
        'name' => ['name' => 'name', 'show_name' => '配置项', 'type' => 'text', 'list_show' => true],
        'value' => ['name' => 'value', 'show_name' => '配置内容', 'type' => 'text', 'list_show' => true],
        'autoload' => ['name' => 'autoload', 'show_name' => '自动加载', 'type' => 'text', 'list_show' => true],

    ];
    private static $validateRule = [
        'name'      => 'required|max:255',
        'value'     => 'required',
        'autoload'  => 'required',
    ];

    public static function getMetaData()
    {
        return self::$metaData;
    }

    public static function getValidateRule()
    {
        return self::$validateRule;
    }
}
