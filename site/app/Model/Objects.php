<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Objects extends Model
{
    use SoftDeletes;
    protected $table='object';
    protected $dates = ['deleted_at'];
    public static $item_type = array(
        'type'=>array(
            '0'=>'请选择',
            '1'=>'奖项',
            '2'=>'排名',
        ),
        'period_type'=>array(
            '0'=>'请选择',
            '1'=>'年',
            '2'=>'月',
            '3'=>'周',
            '4'=>'日',
            '5'=>'固定',
        )
    );

    public static function getItemTree(){
        $items = self::all()->toArray();
        $resetData = array();
        foreach ($items as $key=>$value){
            $resetData[$value['id']] = $value;
        }
        return $resetData;
    }
    public function instances(){
        return $this->hasMany('App\Model\Instance','item_id');
    }




}
