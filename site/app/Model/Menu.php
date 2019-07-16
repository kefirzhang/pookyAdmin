<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public static function tree()
    {
        $records = self::all();
        //格式化成树状结构
        return $records = self::initOneLevelShow($records);

    }

    public static function initOneLevelShow($records, $p_id = 0,$level = 0)
    {
        $backData = [];
        foreach ($records as $record) {
            if ($record['p_id'] == $p_id) {
                $record['level'] = $level;
                $record['level_pre'] = str_repeat('-',$level);
                $backData[] = $record;
                $backData = array_merge($backData, self::initOneLevelShow($records, $record['id'],$level+1));
            }
        }
        return $backData;
    }

    public static function initTree($records, $p_id = 0, $level = 0)
    {
        $backData = [];
        foreach ($records as $record) {
            if ($record['p_id'] == $p_id) {
                $record['level'] = $level;
                $record['nodes'] = self::initTree($records, $record['id'], $level + 1);
                $backData[] = $record;
            }
        }
        return $backData;
    }


}
