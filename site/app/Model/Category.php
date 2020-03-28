<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $table = 'category';
    protected $dates = ['deleted_at'];

    public static function categoryTree($oneLevel = false)
    {
        $categorys = self::all()->toArray();
        $categorysTree = array();
        $levelCategorys = array('0' => array('id' => '0', 'name' => '顶级分类'));
        foreach ($categorys as $key => $value) {
            $levelCategorys[$value['id']] = $value;
            if ($value['parent_id'] == '0') {
                if (isset($categorysTree[$value['id']])) {
                    $categorysTree[$value['id']] = array_merge($categorysTree[$value['id']], $value);
                } else {
                    $categorysTree[$value['id']] = $value;
                }
            } else {
                $categorysTree[$value['parent_id']]['sons'][$value['id']] = $value;
            }
        }
        if ($oneLevel)
            return $levelCategorys;
        else
            return $categorysTree;
    }

    public function items()
    {
        return $this->hasMany('App\Model\Objects', 'category_id');
    }

}
