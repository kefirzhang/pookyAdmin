<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Cell extends Model
{
    protected $table = 'cell';
    protected $dates = ['deleted_at'];
    //
    public static function getInstanceCell($instance_id){
        $cells = self::where('instance_id',$instance_id)->get();
        $cells_data = array();
        foreach ($cells as $key=>$value){
            $cells_data[$value['meta_x_id']][$value['meta_y_id']] = $value->content;
        }
        return $cells_data;
    }
}
