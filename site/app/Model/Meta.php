<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meta extends Model
{
    use SoftDeletes;
    //
    protected $table = "meta";
    protected $dates = ['deleted_at'];

    public static function getMetas($object_id, $type)
    {
        $metas = self::where(['object_id' => $object_id, 'type' => $type])->get();
        $resetData = array();
        foreach ($metas as $key => $value) {
            $resetData[$value['id']] = $value;
        }
        return $resetData;
    }
}
