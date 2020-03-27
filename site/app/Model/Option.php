<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    //
    protected $table = "options";

    public static function initOption($autoload = 1)
    {
        $records = self::where('autoload', $autoload)->get();
        $backData = [];
        foreach ($records as $record) {
            $backData[$record['alias_name']] = $record;
        }
        return $backData;
    }
}
