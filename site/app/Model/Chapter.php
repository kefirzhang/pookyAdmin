<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    //
    protected $table = "book_chapter";

    private static $metaData = [
        'b_id' => ['name' => 'b_id', 'show_name' => '图书ID', 'type' => 'text'],
        'bs_id' => ['name' => 'bs_id', 'show_name' => '当前规则ID', 'type' => 'text'],
        'content' => ['name' => 'content', 'show_name' => '章节内容', 'type' => 'text'],
        'ref_id' => ['name' => 'ref_id', 'show_name' => '源id', 'type' => 'text'],
        'order' => ['name' => 'order', 'show_name' => '顺序', 'type' => 'text'],
    ];
    private static $validateRule = [
        'b_id' => 'required',
        'bs_id' => 'required',
        'content' => 'required',
        'ref_id' => 'required',
        'order' => 'required',
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
