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

    public static function getUnits($item_id,$type){
        $units = self::where(['item_id'=>$item_id,'type'=>$type])->get();
        $resetData = array();
        foreach ($units as $key=>$value){
            $resetData[$value['id']] = $value;
        }
        return $resetData;
    }
}
