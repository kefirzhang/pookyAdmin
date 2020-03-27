<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';

    public static function initOneLevelShow($records = [], $p_id = 0,$level = 0)
    {
        if(empty($records)) {
            $records = self::orderBy('order', 'asc')->get();
        }
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

    public static function initTree($records = [], $p_id = 0, $level = 0)
    {

        if(empty($records)) {
            $records = self::orderBy('order', 'asc')->get();
        }
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
