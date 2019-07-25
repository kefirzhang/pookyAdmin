<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    //
    protected $table = "log";

    private static $metaData = [
        //'' => ['name' => '', 'show_name' => '', 'type' => 'text', 'list_show' => true],
        'flow' => ['name' => 'flow', 'show_name' => '流水号', 'type' => 'text', 'list_show' => false],
        'module' => ['name' => 'module', 'show_name' => '模块', 'type' => 'text', 'list_show' => true],
        'intro' => ['name' => 'intro', 'show_name' => '简介', 'type' => 'text', 'list_show' => false],
        'code' => ['name' => 'code', 'show_name' => '错误码', 'type' => 'text', 'list_show' => true],
        's_code' => ['name' => 's_code', 'show_name' => '子错误码', 'type' => 'text', 'list_show' => true],
        'content' => ['name' => 'content', 'show_name' => '日志内容', 'type' => 'text', 'list_show' => true],
    ];

    private static $validateRule = [
        'flow'      => 'required|max:255',
        'module'     => 'required',
        'intro'     => 'required',
        'code'     => 'required',
        's_code'     => 'required',
        'content'  => 'required',
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
